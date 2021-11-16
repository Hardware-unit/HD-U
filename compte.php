<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8" />
    <title>Mon compte</title>
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>">
    <link rel="stylesheet" type="text/css" href="CSS/compte.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");
    ?>
    <div class="contenu">
        <?php
        if (count($_POST) > 0) {
            $mail = $_POST["mail"];
            $tel = $_POST["phone"];
            $ddn = $_POST["birth"];
            $sex = $_POST["genre"];

            $sql2 = "SELECT count(*) FROM utilisateur WHERE Email = '$email' or tel = '$letel' ";
            $result = mysqli_query($conn, $sql2);

            $row = mysqli_fetch_array($result);

            if ($row[0] > 0) {
                echo "information: Email ou téléphone déjà utilisé. Avez vous déjà un compte ?";
            } else {
                $sql1 = "UPDATE `utilisateur` SET `Email` = '$mail',`Date_De_Naissance`= '$ddn',`tel`= '$tel',`sexe`= $sex WHERE `ID` = " . $USER_INFO->getID();
                $res = mysqli_query($conn, $sql1);
                header("location:index.php");
            }
        }
        /*$sql2 = "SELECT count(*) FROM utilisateur WHERE Email = '$mail' ";
            $sql3 = "SELECT count(*) FROM utilisateur WHERE tel = '$tel' ";
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $row2 = mysqli_fetch_array($result2);
            $row3 = mysqli_fetch_array($result3);
               if ($mail != $USER_INFO->getEmail() || $tel != $USER_INFO->getTel()) {
                if ($row2[0] > 0 && $row3[0] > 0) {
                    echo "information: Email et numero de téléphone déjà utilisé.";
                } elseif ($row2[0] > 0) {
                    echo "information: Email déjà utilisé.";
                } elseif ($row3[0] > 0) {
                    echo "information: tel déjà utilisé.";
                } else {
                    $sql1 = "UPDATE `utilisateur` SET `Email` = '$mail',`Date_De_Naissance`= '$ddn',`tel`= '$tel',`sexe`= $sex WHERE `ID` = " . $USER_INFO->getID();
                    $res = mysqli_query($conn, $sql1);
                    header("location:index.php");
                } 
            } else {
                $sql1 = "UPDATE `utilisateur` SET `Email` = '$mail',`Date_De_Naissance`= '$ddn',`tel`= '$tel',`sexe`= $sex WHERE `ID` = " . $USER_INFO->getID();
                $res = mysqli_query($conn, $sql1);
                header("location:index.php");
            }*/ //$sql = "UPDATE `utilisateur` SET `MotDePasse` = 'nouveau' WHERE `MotDePasse` = 'ancien'";
        ?>
        <form action="compte.php" method="POST">
            <div class="compte">
                <?php if (isset($USER_INFO)) { ?>
                    <div>
                        <input type="text" name="Firstname" disabled value="<?= $USER_INFO->getNom() ?>">
                    </div>
                    <div>
                        <input type="text" name="Lastname" disabled value="<?= $USER_INFO->getPrenom() ?>">
                    </div>
                    <div>
                        <input type="text" name="mail" value="<?= $USER_INFO->getEmail() ?>">
                    </div>
                    <div>
                        <input type="text" name="phone" value="<?= $USER_INFO->getTel() ?>">
                    </div>
                    <div>
                        <input type="date" name="birth" value="<?= $USER_INFO->getDate_De_Naissance() ?>">
                    </div>
                    <div>
                        <select name="genre" id="gr">
                            <option value="1" <?php if ($USER_INFO->getSexe() == 1) {
                                                    echo "selected";
                                                } ?>>Homme</option>
                            <option value="2" <?php if ($USER_INFO->getsSexe() == 2) {
                                                    echo "selected";
                                                } ?>>Femme</option>
                            <option value="3" <?php if ($USER_INFO->getSexe() == 3) {
                                                    echo "selected";
                                                } ?>>Personnalisé</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Envoyer">
                    </div>
                <?php
                }
                ?>
            </div>
        </form>
        <div>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>
                                <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                                <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                                <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                                <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                                <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                                <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                                <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>
                                <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                                <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                            <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                            <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>