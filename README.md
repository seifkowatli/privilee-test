# Privilee-test
Privailee Coding Test



## How to Run the Project

To run the project, follow these steps:

1. First, install Composer dependencies by running:
    ```bash
    composer install
    ```

2. Then, start the Laravel server by executing:
    ```bash
    php artisan serve
    ```

For the frontend:

1. Install npm dependencies:
    ```bash
    npm i
    ```

2. Compile frontend assets:
    ```bash
    npm run dev
    ```

## Potential Improvements

### Backend

- Create a DTO for incoming filters.
- Implement a filter pipeline to validate and filter input using the pipeline pattern and generic classes.
- Refactor controllers to expose only API endpoints and move business logic to reusable repository classes, utilizing dependency injection to inject repositories into controllers.
- Implement a file converter server and integrate it into Laravel commands.

(Note: XML conversion code is partially implemented and can be found commented in the backend project due to time constraints.)

### Frontend

- Develop a Card component for the carousel slider.
- Separate filtration concerns from other components.
- Optimize API requests by waiting for the user to finish typing before sending the next request to improve performance and reduce backend load.
- Implement structural improvements such as having custom hooks for each resource handling error and success notifications. An example of this approach can be found in the custom React library "craft-ki-mui" [here](https://github.com/seifkowatli/craft-kit-mui).


