## KEFIS CLIENT

### this is the frontend for the Kefis application.
##### this fronted simulates the functionalites that the aplication handles, and as it is accessed through the dashboard one is able to;
-View dispatched orders(as fulfilled orders)
-Dispatch products from the warehouse to store
-View list of products
-View inventory(quantity)
-Status of an order(fulfilled/unfulfilled)
-Make automated reorders from the store to the warehouse once the product inventory is below a predefined quantity.
-Simulating sale of products by reducing the Inventory
-the views are to accessed through {base url}/index.html then click on the respective view on the Navbar, for Warehouse = {{base url}}/products.html and for Store = {{base url}}/stores.html
-This demonstrates a simple approach to creating the frontend.

The application is restricted to access the API endpoints through the url and port: 5500, though this can be changed by accessing the file located at the backend folder; /app/Http/Middleware/CorsMiddleware.php

