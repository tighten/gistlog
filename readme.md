![Gistlog logo](https://raw.githubusercontent.com/tighten/gistlog/main/gistlog-banner.png)

# GistLog

[![Build Status](https://travis-ci.org/tightenco/gistlog.png?branch=main)](http://travis-ci.org/tightenco/gistlog)

Turn your gists into easy, beautiful, responsive blog posts--a "GistLog". Just paste a Gist URL into [GistLog.co](https://gistlog.co/) and you're up and running.

You can also just replace `gist.github.com` in any URL with `gistlog.co`, and you instantly have a beautiful GistLog.

An exercise in iterative development by [Matt Stauffer](http://mattstauffer.co/) and [Adam Wathan](http://adamwathan.me/) of [Tighten Co.](http://tighten.co/).

## Requirements

 * PHP >= 7.1.3
 * Composer

## Installation

1. Clone the repository locally
2. Install dependencies with `composer install`
3. Copy `.env.example` to `.env` and modify its contents to reflect your local environment
4. Configure a web server, such as the built-in PHP web server, to serve this site using the +public+ directory as its root
5. Go to https://github.com/settings/developers and create a Oauth app 
6. Create a token here https://github.com/settings/tokens that has access right to Gist

```bash
php -S localhost:8080 -t public
```

## Questions
If you have any questions, please reach out to [@mattstauffer](https://github.com/mattstauffer). Find him here or on twitter at [@stauffermatt](https://twitter.com/stauffermatt).

## Contributing

Please see the [contributing.md](https://github.com/tighten/gistlog/blob/main/contributing.md) for more explicit instructions on how to contribute to the project.

If you have an idea for the project, please look at the [open issues](https://github.com/tighten/gistlog/issues), and if your idea isn't there, open an issue for discussion.You can write a pull request without validating the idea first, but it will open up the possibility that you spend a lot of time writing a feature and it gets rejected.
