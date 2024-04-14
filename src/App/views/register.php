<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="/assets/main.css" />
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-0 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="./sources/logo2.png" style="width: 185px;" alt="logo">
                                        <h3 class="mt-1 mb-5 pb-1">Registration</h3>
                                    </div>

                                    <form method="POST">
                                        <?php include $this->resolve('partials/_csrf.php'); ?>

                                        <p class="mb-4">Please enter your data:</p>
                                        <div class="col-md-6 mb-1">
                                            <div class="form-outline">
                                                <input type="text" value="<?php echo e($oldFormData['userName'] ?? ''); ?>" name="userName" id="form3Example1" class="form-control" />
                                                <label class="form-label" for="form3Example1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg> Your name</label>
                                                <?php if (array_key_exists('userName', $errors)) : ?>
                                                    <div class="error">
                                                        <?php echo e($errors['userName'][0]); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input type="email" value="<?php echo e($oldFormData['email'] ?? ''); ?>" name="email" id="form3Example3" class="form-control" />
                                            <label class="form-label" for="form3Example3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                </svg> Email address</label>
                                            <?php if (array_key_exists('email', $errors)) : ?>
                                                <div class="error">
                                                    <?php echo e($errors['email'][0]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input type="password" value="" name="password" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg> Password</label>
                                            <?php if (array_key_exists('password', $errors)) : ?>
                                                <div class="error">
                                                    <?php echo e($errors['password'][0]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input type="password" value="" name="confirmPassword" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg> Repeat password</label>
                                            <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                                                <div class="error">
                                                    <?php echo e($errors['confirmPassword'][0]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input me-2" type="checkbox" name="regulations" id="form2Example33" <?php echo $oldFormData['regulations'] ?? false ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="form2Example33">
                                                I accept the terms
                                            </label>
                                        </div>
                                        <?php if (array_key_exists('regulations', $errors)) : ?>
                                            <div class="error">
                                                <?php echo e($errors['regulations'][0]); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="text-center pt-1 mb-1 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                                </svg> Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h3 class="mb-4">
                                        <p>Using a budget app can bring numerous benefits to your financial life.
                                            Here are a few reasons why you should consider using a budget app:
                                    </h3>
                                    <div class="newFont">
                                        <ul>
                                            <li>Track Your Expenses</li>
                                            <li>Stay Organized</li>
                                            <li>Set Financial Goals</li>
                                            <li>Avoid Overspending</li>
                                            <li>Gain Financial Awareness</li>
                                            <li>Save Time and Effort</li>
                                        </ul>
                                    </div>
                                    <div class="text-center mt-4">
                                        <img src="img/wallet.png" style="border-radius: 10px; width: 295px;" alt="orange wallet with money">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>