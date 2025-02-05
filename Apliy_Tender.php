<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create & Apply for Tender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- <div class="container mt-5">
        <h2 class="text-center">Admin - Create Tender</h2>
        <form action="create_tender.php" method="post">
            <div class="mb-3">
                <label class="form-label">Tender Title</label>
                <input type="text" class="form-control" name="tender_title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tender Reference Number</label>
                <input type="text" class="form-control" name="tender_ref" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" class="form-control" name="deadline" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Tender</button>
        </form>
    </div> -->

    <div class="container mt-5">
        <h2 class="text-center">Supplier - Apply for Tender</h2>
        <form action="apply_tender.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Supplier Name</label>
                <input type="text" class="form-control" name="supplier_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tender Reference Number</label>
                <input type="text" class="form-control" name="tender_ref" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Proposal Document</label>
                <input type="file" class="form-control" name="proposal_document" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Offered Price</label>
                <input type="number" class="form-control" name="offered_price" required>
            </div>
            <button type="submit" class="btn btn-success">Apply for Tender</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
