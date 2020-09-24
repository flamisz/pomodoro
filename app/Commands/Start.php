<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Start extends Command
{
    const DEFAULT_POMODORO_MIN = 25;
    const DEFAULT_BREAK_MIN = 5;
    const DEFAULT_POMODORO_COUNT = 4;
    const DEFAULT_LONG_BREAK = 30;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'start
                            {--min= : pomodoro timer in minutes (default: 25)}
                            {--break= : break between rounds (default: 5)}
                            {--rounds= : how many rounds (deafult: 4)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Start pomodoro ⏲';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pomodoroMin = $this->option('min') ?: self::DEFAULT_POMODORO_MIN;
        $pomodoroCount = $this->option('break') ?: self::DEFAULT_POMODORO_COUNT;
        $pomodoroBreak = $this->option('rounds') ?: self::DEFAULT_BREAK_MIN;
        $longBreak = self::DEFAULT_LONG_BREAK;

        $this->info('Pomodoro started at: ' . now());

        collect(range(1, $pomodoroCount, 1))->each(function ($item) use ($pomodoroMin, $pomodoroBreak, $pomodoroCount, $longBreak) {
            $this->info("\n${item}. pomodoro 💻");

            $this->bar($pomodoroMin);

            $break = $item < $pomodoroCount ? $pomodoroBreak : $longBreak;

            $message = "{$item}. pomodoro has finished. Take a {$break} minute break";
            $this->info("\n{$message}");
            $this->notify('Pomodoro', "\n{$message}", 'icon.png');

            if ($item < $pomodoroCount) {
                $this->info("☕️");

                $this->bar($pomodoroBreak);

                $message = "{$item}. break has finished. Let's get back to work 💻";
                $this->comment("\n{$message}");
                $this->notify('Pomodoro', "\n{$message}", 'icon.png');
            }
        });

        $this->info("\nPomodoro finished at: " . now());
    }

    protected function bar(int $range)
    {
        $bar = $this->output->createProgressBar($range);

        $bar->setFormat('[%bar%] %current%/%max% min');

        $bar->start();

        collect(range(1, $range, 1))->each(function () use ($bar) {
            sleep(60);
            $bar->advance();
        });

        $bar->finish();
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
