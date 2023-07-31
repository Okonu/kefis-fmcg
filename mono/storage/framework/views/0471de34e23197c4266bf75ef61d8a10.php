
<?php $__env->startSection('content'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                   <!-- Store Products Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Store Products</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="storeProductsTable" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Inventory</th>
                                    <th>Sale</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Fulfilled Orders Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fulfilled Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="fulfilledOrdersTable" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Order Number</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <script>
        async function fetchStoreProducts() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/store_products');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching store products:', error);
                return [];
            }
        }

        async function reduceInventory(storeProduct_id, quantity) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/store_products/${storeProduct_id}/reduce-inventory`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                });
                const data = await response.json();
                console.log(data.message);
                return data;
            } catch (error) {
                console.error('Error reducing inventory:', error);
                return null;
            }
        }

        function populateStoreProductsTable(data) {
            const tableBody = document.getElementById('storeProductsTable').getElementsByTagName('tbody')[0];

            data.forEach(product => {
                const row = tableBody.insertRow();
                const productNameCell = row.insertCell();
                const inventoryCell = row.insertCell();
                const saleCell = row.insertCell();

                productNameCell.innerText = product.name;
                inventoryCell.innerText = product.inventory;

                const saleButton = document.createElement('button');
                saleButton.textContent = 'Sale';
                saleButton.classList.add('btn', 'btn-warning');
                saleButton.addEventListener('click', async () => {
                    const response = await reduceInventory(product.id, 1);
                    if (response) {
                        updateFulfilledOrdersTable(response);
                    }
                });
                saleCell.appendChild(saleButton);
            });
        }

        function populateFulfilledOrdersTable(data) {
            const tableBody = document.getElementById('fulfilledOrdersTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            if (data.fulfillment_details) {
                const row = tableBody.insertRow();
                const productNameCell = row.insertCell();
                const quantityCell = row.insertCell();
                const orderNumberCell = row.insertCell();

                productNameCell.innerText = data.fulfillment_details.product_name;
                quantityCell.innerText = data.fulfillment_details.quantity;
                orderNumberCell.innerText = data.fulfillment_details.order_number;
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const storeProductsData = await fetchStoreProducts();
            populateStoreProductsTable(storeProductsData);
            
            populateFulfilledOrdersTable({});
        });
    </script>
    <?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Boost Your Business\Desktop\value8\kefis\mono\resources\views/store/index.blade.php ENDPATH**/ ?>