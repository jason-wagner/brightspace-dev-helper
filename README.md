# Brightspace Dev Helper
This open-source package was built to make it easier to use the API (Valence) and data exports (Data Hub) of D2L Brightspace.

This package is written in PHP. If you do not use PHP, while the packages themselves may not be of direct use to you in your applications, it may inspire you to port them over to the language of your choice.

You'll find that the documentation of this package is sparse, which is intentional. The primary functionality for this package is to use with an IDE, like PhpStorm, which offers completion for using classes, functions, fields, etc.

Want to enroll a user in a course with Valence? Just type <code>$valenceobjectname->enroll</code> and check the autocompletes for the function that contains action you're looking for. The idea is that you will not need to dig through documentation, or memorize all the API routes and fields. You'll use autocomplete to do it for you.

Want to access information from the Data Hub? Just type the name of the report you want to retrieve data from (which should autocomplete for you) and access information using the Eloquent ORM.

If you do not use an IDE with class-awareness and autocompletion, this package problem won't help you very much. In fact, it will probably increase the amount of time it takes to develop applications with the API as it just adds another layer of documentation you need to read.

## Status
This package is currently a <strong>preview release</strong>. The first official release is expected in January. After the first official release, breaking changes will be avoided whenever possible, with the exception being breaking changes as a result of changes in the Valence API itself. However, as last minute details are worked out, there may be changes to this preview release that may cause code you create with this to be changed. It is being offered for experimental purposes at this time.

## Contributions
This is an open source package. At this time, contributions are not being accepted. Many of the planned features are built out and in extended custom clients and will be implemented in the future, some of which depend on particular naming conventions and other consistencies that are not yet documented. Once these are implemented, we will accept merged requests into the official repository. In the meantime, you can extend your clients locally, or create your own composer packages with extend this one.

## Documentation
To view the documentation, see [https://jason-wagner.github.io/brightspace-dev-helper](https://jason-wagner.github.io/brightspace-dev-helper).
