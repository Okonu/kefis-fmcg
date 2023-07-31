
<?php $__env->startSection('content'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Processed Orders</h1>
                    <p class="mb-4">These are the processed orders</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="processedOrdersTable">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Inventory</th>
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
        async function fetchProcessedOrders() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/processed_orders');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching processed orders:', error);
                return [];
            }
        }
    
        function populateTable(data) {
            const tableBody = document.getElementById('processedOrdersTable').getElementsByTagName('tbody')[0];
    
            data.forEach(order => {
                const row = tableBody.insertRow();
                const productNameCell = row.insertCell();
                const inventoryCell = row.insertCell();
                const orderNumberCell = row.insertCell();
    
                productNameCell.innerText = order.product.name;
                inventoryCell.innerText = order.product.inventory;
                orderNumberCell.innerText = order.order_number;
            });
        }
    
        document.addEventListener("DOMContentLoaded", async () => {
            const data = await fetchProcessedOrders();
            populateTable(data);
        });

    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Boost Your Business\Desktop\value8\mono\resources\views/products/orders.blade.php ENDPATH**/ ?>