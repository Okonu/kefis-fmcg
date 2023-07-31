
<?php $__env->startSection('content'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="productsTable" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Inventory</th>
                                            <th>Fulfilled Status</th>
                                            <th>Order Number</th>
                                            <th>Dispatch</th>
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
        async function fetchProducts() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/products');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching products:', error);
                return [];
            }
        }
    
        async function dispatchProduct(product_id) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/products/${product_id}/dispatch`, {
                    method: 'POST',
                });
                const data = await response.json();
                console.log(data.message);
            } catch (error) {
                console.error('Error dispatching product:', error);
            }
        }
    
        function populateTable(data) {
            const tableBody = document.getElementById('productsTable').getElementsByTagName('tbody')[0];
    
            data.forEach(product => {
                const row = tableBody.insertRow();
                const productNameCell = row.insertCell();
                const inventoryCell = row.insertCell();
                const fulfillmentCell = row.insertCell();
    
                productNameCell.innerText = product.name;
                inventoryCell.innerText = product.inventory;
    
                if (product.fulfilled_orders.length > 0) {
                    fulfillmentCell.innerText = 'Fulfilled';
                    const orderNumberCell = row.insertCell();
                    orderNumberCell.innerText = product.fulfilled_orders[0].order_number;
                } else {
                    fulfillmentCell.innerText = 'Unfulfilled';
                    const orderNumberCell = row.insertCell();
                    orderNumberCell.innerText = 'NA';
                }
    
                const dispatchCell = row.insertCell();
                if (product.fulfilled_orders.length === 0) {
                    const dispatchButton = document.createElement('button');
                    dispatchButton.textContent = 'Dispatch';
                    dispatchButton.classList.add('btn', 'btn-success');

                    //dispatchButton.addEventListener('click', () => dispatchProduct(product.id));
                    dispatchCell.appendChild(dispatchButton);
                }
            });
        }
    
        document.addEventListener('DOMContentLoaded', async () => {
            const data = await fetchProducts();
            populateTable(data);
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Boost Your Business\Desktop\value8\kefis\mono\resources\views/warehouses/index.blade.php ENDPATH**/ ?>