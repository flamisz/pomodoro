## Pomodoro?

The Pomodoro Technique is a time management method developed by Francesco Cirillo in the late 1980s.

There are six steps in the original technique:

1. Decide on the task to be done.
1. Set the pomodoro timer (traditionally to 25 minutes).
1. Work on the task.
1. End work when the timer rings and put a checkmark on a piece of paper.
1. If you have fewer than four checkmarks, take a short break (3–5 minutes) and then return to step 2; otherwise continue to step 6.
1. After four pomodoros, take a longer break (15–30 minutes), reset your checkmark count to zero, then go to step 1.

## How to use it

This is a php app. Clone the repo and type: `php pomodoro start`.
Other way to download the `builds/pomodoro` file and run it: `./pomodoro start`.

## Options

By default, there are 4 rounds, each 25 minutes and 5 minutes break between the rounds. You can customize these values with arguments:
```
--min[=MIN]        pomodoro timer in minutes (default: 25)
--break[=BREAK]    break between rounds (default: 5)
--rounds[=ROUNDS]  how many rounds (deafult: 4)
```

Run like this:
`php pomodoro start --rounds=3 --min=20 --break=4` or `./pomodoro start --rounds=3 --min=20 --break=4`

## License

Laravel Zero is an open-source software licensed under the [MIT license](https://github.com/flamisz/pomodoro/blob/master/LICENSE).
