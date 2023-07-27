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

The application is restricted to access the API endpoints through the url and port: 5500, though this can be changed by accessing the file located at the backend folder; /app/Http/Middleware/CorsMiddleware.php

