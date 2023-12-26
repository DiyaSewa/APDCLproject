<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="h1">
                <p class="text-color text-center">Write your Complaint</p>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-10">
                <a class="btn btn-primary" href="index.php"> <&nbsp; Back</a>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <form method="post" action="success.html">

                <div class="row">
                    <div class="col-4">
                        <label for="type" class="form-label">Type of Complaint:</label>
                    </div>
                    <div class="col-8">
                        <select class="form-select" name="type" id="type" required>
                            <option value="" selected>Select Type</option>
                            <option value="Billing">Billing</option>
                            <option value="Electricity'">Electricity</option>
                            <option value="Black-out">Black-out</option>
                            <option value="Transformer">Transformer</option>
                            <option value="Meter no">Meter no</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="severity" class="form-label">Severity:</label>
                    </div>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="severe" id="severe" value="low" checked>
                            <label class="form-check-label" for="inlineRadio1">Low</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="severe" id="severe" value="medium">
                            <label class="form-check-label" for="inlineRadio1">Medium</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="severe" id="severe" value="high">
                            <label class="form-check-label" for="inlineRadio1">High</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="severe" id="severe" value="very high">
                            <label class="form-check-label" for="inlineRadio1">Very High</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="content" class="form-label">Desribe your complaint:</label>
                    </div>
                    <div class="col-8">
                        <textarea required name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Please write a short description of your problem"></textarea>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-10 col-sm-8"></div>
                    <div class="col-md-2 col-sm-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="success()">Submit</button>
                        <button type="reset" class="btn btn-secondary">Clear All</button>
                    </div>
                </div>
                
            </form>
        </div>   
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>