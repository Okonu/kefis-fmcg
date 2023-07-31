
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
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e($product->inventory); ?></td>
            <td>
                <?php if($product->fulfilledOrders && $product->fulfilledOrders->count() > 0): ?>
                    Fulfilled
                <?php else: ?>
                    Unfulfilled
                <?php endif; ?>
            </td>
            <td>
                <?php if($product->fulfilledOrders && $product->fulfilledOrders->count() > 0): ?>
                    <?php echo e($product->fulfilledOrders->first()->order_number); ?>

                <?php else: ?>
                    NA
                <?php endif; ?>
            </td>
            <td>
                <?php if(!$product->fulfilledOrders || $product->fulfilledOrders->count() === 0): ?>
                    <button class="btn btn-success" onclick="dispatchProduct(<?php echo e($product->id); ?>)">Dispatch</button>
                <?php else: ?>

                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        async function fetchProducts(){
            try {
                const response = await fetch("/products");

                if(!response.ok){
                    throw new Error('Network Error');
                }
                const data = await response.json();
                return data;
            } catch (error){
                console.error('Error fetching products:', error);
                return [];
            }
        }
        async function dispatchProduct(product_id) {
            try {
                const response = await fetch(`/products/${product_id}/dispatch`, {
                method: 'POST',
            });
                if (!response.ok) {
                    throw new Error('Network Error');
                }
                const data = await response.json();
                console.log(data.message);

                const updatedData = await fetchProducts();
                populateTable(updatedData);
            } catch (error) {
                console.error('Error dispatching product:', error);
            }
        }

        function populateTable(data) {
            const tableBody = document.getElementById('productsTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = "";

            data.forEach(product => {
                const row = tableBody.insertRow();
                const productNameCell = row.insertCell();
                const inventoryCell = row.insertCell();
                const fulfillmetCell = row.insertCell();
                const orderNumberCell = row.insertCell();

                productNameCell.innerText = product.name;
                inventoryCell.innerText = product.inventory;

                if (product.fulfilled_orders.length > 0) {
                    fulfillementCell.innerText = 'Fulfilled';
                    orderNumberCell.innerText = product.fulfilled_orders[0].order_number;
                } else {
                    fulfillmetCell.innerText = 'Unfulfilled';
                    orderNumberCell.innerText = 'NA';
                }

                if (product.fulfilled_orders.length === 0) {
                    const dispatchButton = document.createElement('button');
                    dispatchButton.textContent = 'Dispatch';
                    dispatchButton.classList.add('btn btn-success');

                    dispatchButton.addEventListener('click', () => dispatchProduct(product.id));
                    dispatchCell.appendChild(dispatchButton);
                } else {
                    dispatchCell.innerText = '-';
                }
            })
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const data = await fetchData();
            populateTable(data);
        });

    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Boost Your Business\Desktop\value8\mono\resources\views/products/index.blade.php ENDPATH**/ ?>