# Change Log for Gamajo Template Loader

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [1.3.1] - 2018-09-24

- Fix coding standards.

## [1.3.0] - 2017-03-24

- Add prefixed get_template_part filter.
- Add a template cache to store previously located template paths.
- Add a custom data variable name cache, so `unset_template_data()` can remove all custom references.
- Update `set_template_data()` and `unset_template_data()` to become fluent methods.
- Remove array type hint from `set_template_data()` argument.
- Update documentation.

## [1.2.0] - 2016-03-26

- Support adding custom template data.
- Add check around class definition if class exists.
- Added `composer.json`.
- Fix code standards.
- Improve README.
- Move example meal planner class into README.

## [1.1.0] - 2014-03-08

- Fix bug so that the more specific template is preferred.
- Cache template path in a local variable.
- Change access to `locate_template()` method to public.
- Add `$plugin_template_directory` property.
- Initialise `$templates` variable.
- Add check if class exists in example code.
- Improve README

## 1.0.0 - 2013-12-09

- Initial release.

[1.3.1]: https://github.com/GaryJones/Gamajo-Template-Loader/compare/1.3.0...1.3.1
[1.3.0]: https://github.com/GaryJones/Gamajo-Template-Loader/compare/1.2.0...1.3.0
[1.2.0]: https://github.com/GaryJones/Gamajo-Template-Loader/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/GaryJones/Gamajo-Template-Loader/compare/1.0.0...1.1.0
