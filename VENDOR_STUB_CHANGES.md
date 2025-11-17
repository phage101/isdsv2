Updates to `vendor/pqrs/l5b-crud` stubs

Date: 2025-11-17

Summary:
- Updated event stubs to use `DummyVariable` instead of `DummyTable` for the generated event property and constructor parameter. This ensures generated event classes use the expected model-variable naming (e.g. `$province`).
- Updated backend and frontend listener stubs to reference `DummyVariable` (e.g. `$event->DummyVariable->field`) to match the event property.

Files modified:
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-event-created.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-event-updated.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-event-deleted.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-frontend-event-created.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-frontend-event-updated.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-frontend-event-deleted.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-listener.stub
- vendor/pqrs/l5b-crud/src/Console/Commands/Stubs/make-frontend-listener.stub

Notes:
- All modified stubs were linted with `php -l` and contain no syntax errors.
- These changes make `l5b:crud` / `l5b:stub` generated events/listeners consistent with the variable naming tokens used by the stub generator.

Recommended next steps:
- Run a quick scaffold using the package to verify generated files match your project's conventions.
- Optionally open a PR against the `pqrs/l5b-crud` package to include these fixes upstream.
