<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Start extends Command
{
    const DEFAULT_POMODORO_MIN = 5;
    const DEFAULT_BREAK_MIN = 2;
    const DEFAULT_POMODORO_COUNT = 4;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'start';

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
        $pomodoroMin = self::DEFAULT_POMODORO_MIN;
        $pomodoroCount = self::DEFAULT_POMODORO_COUNT;
        $pomodoroBreak = self::DEFAULT_BREAK_MIN;

        $this->info('Pomodoro started at: ' . now());

        collect(range(1, $pomodoroCount, 1))->each(function ($item) use ($pomodoroMin, $pomodoroBreak, $pomodoroCount) {
            $this->bar($pomodoroMin);
            $message = "{$item}. pomodoro has finished. Take a {$pomodoroBreak} minute break ☕️";
            $this->info("\n{$message}");
            $this->notify('Pomodoro', "\n{$message}", 'icon.png');

            if ($item < $pomodoroCount) {
                $this->bar($pomodoroBreak);
                $message = "{$item}. break has finished. Let's get back to work 💻";
                $this->comment("\n{$message}");
                $this->notify('Pomodoro', "\n{$message}", 'icon.png');
            }
        });

        $this->info('Pomodoro finished at: ' . now());
    }

    protected function bar(int $range)
    {
        $bar = $this->output->createProgressBar($range);

        $bar->setFormat('[%bar%] %current%/%max% min');

        $bar->start();

        collect(range(1, $range, 1))->each(function () use ($bar) {
            sleep(1);
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
