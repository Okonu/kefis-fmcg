# KEFIS INVENTORY SYSTEM

## Endpoints for the application;
1. {{base_url}}/products/{product_id}/dispatch HTTP Method: GET
- dispatches products to the store
-dispatched products autoincrement in the store table
2. {{base_url}}/processed_orders HTTP Method: GET
-lists all processed orders at the warehouse
3. {{base_url}}/products/{product_id}/reduce-inventory HTTP Method: POST
        request body: { "quantity": " }
    - simulates dispatch of products from the warehouse and autoreorders when the inventory is below a predefined level(<=10)
4. {{base_url}}/store_products/{store_product}/reduce-inventory HTTP Method: POST
        request body: { "quantity": "}
        -simulates the slae of products from the store, and autore-orders when the inventory is below the predefined limit(<=10). This happens in one post instance and the response is updated with the new inventory
5. {{base_url}}/store_products HTTP Method: GET
- lists all products in the store
6. {{base_url}}/products HTTP Method: GET
- lists all products in the warehouse




