This is a simple Bill of Materials application.(BOM).

## Setup

1. Clone the repository to your local machine:
2. Navigate to the project directory:
3. Install the required dependencies using Composer:
    ```
    composer install
    ```
3. Create a new database and update the .env file with your database credentials
4. Generate the application key:
    ```
    php artisan key:generate
    ```
5. Run the database migrations to create the necessary tables:
    ```
    php artisan migrate
    ```
6. Start the development server:
    ```
    php artisan serve
    ```
- The application should now be up and running at http://localhost:8000.

## Usage
- Access the BOM in your web browser by visiting the following route:
    http://localhost:8000/products

- On the homepage, you can add new products by providing their names in the input field and clicking "Add Product."

- Once a finished product is added, you can click on its name to view the list of items associated with it.

- To add items to a finished product, click the "Add Item" button, provide the item name in the input field, and click "Add."

- When viewing the list of items, you can click on an item's name to view the list of materials associated with it.

- To add raw materials to an item, click the "Add Material" button, provide the material name and its price in the input fields, and click "Add."

- The total cost of each product is automatically calculated based on the sum of the material costs associated with it.