<?php

declare(strict_types=1);

namespace OrkhanShukurlu\GitArtisan;

use Illuminate\Console\Command;
use Illuminate\Contracts\Process\ProcessResult;
use Illuminate\Support\Facades\Process;

final class GitCommand extends Command
{
    protected $description = 'Run multiple git commands in a single command';

    protected $signature = 'git {message   : Commit the changes with the message}
                                {--pull=   : Pull changes to the branch}
                                {--push=   : Push changes to the branch}
                                {--no-pull : Commit changes without pulling}
                                {--no-push : Commit changes without pushing}';

    public function handle(): int
    {
        $this->status();
        $this->add();
        $this->commit();

        if (! $this->option('no-pull')) {
            $this->pull();
        }

        if (! $this->option('no-push')) {
            $this->push();
        }

        return parent::SUCCESS;
    }

    private function add(): void
    {
        $process = $this->runAddProcess();

        $this->writeInfo('add')->handleOutput($process);
    }

    private function commit(): void
    {
        $process = $this->runCommitProcess();

        $this->writeInfo('commit')->handleOutput($process);
    }

    private function errorOutputOnFailure(ProcessResult $process): void
    {
        if (empty($output = $process->errorOutput())) {
            return;
        }

        $this->error($output);
    }

    private function errorOutputOnSuccess(ProcessResult $process): void
    {
        if (empty($output = $process->errorOutput())) {
            return;
        }

        $this->warn($output);
    }

    private function getCommitMessage(): string
    {
        return $this->argument('message');
    }

    private function getPullBranch(): string
    {
        return $this->option('pull') ?: 'master';
    }

    private function getPushBranch(): string
    {
        return $this->option('push') ?: 'master';
    }

    private function handleOutput(ProcessResult $process): void
    {
        if ($process->failed()) {
            $this->errorOutputOnFailure($process);
            exit;
        }

        $this->errorOutputOnSuccess($process);
        $this->outputOnSuccess($process);
    }

    private function outputOnSuccess(ProcessResult $process): void
    {
        if (empty($output = $process->output())) {
            return;
        }

        $this->info($output);
    }

    private function pull(): void
    {
        $process = $this->runPullProcess();

        $this->writeInfo('pull')->handleOutput($process);
    }

    private function push(): void
    {
        $process = $this->runPushProcess();

        $this->writeInfo('push')->handleOutput($process);
    }

    private function runAddProcess(): ProcessResult
    {
        return Process::run(['git', 'add', '.']);
    }

    private function runCommitProcess(): ProcessResult
    {
        $message = $this->getCommitMessage();

        return Process::run(['git', 'commit', '-m', $message]);
    }

    private function runPullProcess(): ProcessResult
    {
        $branch = $this->getPullBranch();

        return Process::run(['git', 'pull', 'origin', $branch]);
    }

    private function runPushProcess(): ProcessResult
    {
        $branch = $this->getPushBranch();

        return Process::run(['git', 'push', 'origin', $branch]);
    }

    private function runStatusProcess(): ProcessResult
    {
        return Process::run(['git', 'status']);
    }

    private function status(): void
    {
        $process = $this->runStatusProcess();

        $this->writeInfo('status')->handleOutput($process);
    }

    private function writeInfo(string $command): self
    {
        $this->line('<options=bold;bg=magenta>' . strtoupper($command) . '</>');

        return $this;
    }
}
