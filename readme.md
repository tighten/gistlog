# Gistlog

[![Build Status](https://travis-ci.org/tightenco/gistlog.png?branch=master)](http://travis-ci.org/tightenco/gistlog)
[![Stories in Ready](https://badge.waffle.io/tightenco/gistlog.png?label=ready&title=Ready)](https://waffle.io/tightenco/gistlog)

Turn your gists into easy, beautiful, responsive blog posts--a "Gistlog". Just paste a Gist URL into [Gistlog.co](https://gistlog.co/) and you're up and running.

You can also just replace `gist.github.com` in any URL with `gistlog.co`, and you instantly have a beautiful Gistlog.

An exercise in iterative development by [Matt Stauffer](http://mattstauffer.co/) and [Adam Wathan](http://adamwathan.me/) of [Tighten Co.](http://tighten.co/).

## Requirements

 * PHP >= 5.5.9
 * PHP [mcrypt extension](http://php.net/manual/en/book.mcrypt.php)
 * Composer

## Installation

1. Clone the repository locally
2. Install dependencies with `composer install`
3. Copy `.env.example` to `.env` and modify its contents to reflect your local environment
5. Go to https://github.com/settings/developers and create a Oauth app 
6. Create a token here https://github.com/settings/tokens that has access right to Gist

```bash
php -S localhost:8080 -t public
```

7. Go to https://github.com/settings/developers and create a Oauth app 
8. Create a token here https://github.com/settings/tokens that has access right to Gist

## Questions
If you have any questions, please reach out to [@mattstauffer](https://github.com/mattstauffer). Find him here or on twitter at [@stauffermatt](https://twitter.com/stauffermatt).

## Contributing

Please see the [contributing.md](https://github.com/tightenco/gistlog/blob/master/contributing.md) for more explicit instructions on how to contribute to the project.

If you have an idea for the project, please look at the [open issues](issues), and if your idea isn't there, open an issue for discussion.You can write a pull request without validating the idea first, but it will open up the possibility that you spend a lot of time writing a feature and it gets rejected.
