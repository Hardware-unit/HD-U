<div class="up_button">
    <div class="up" onclick="scroll_to_top();">Retour en haut</div>
</div>
<div class="footer">
    <footer>
        <table width="100%">
            <tr>
                <td>nous contacter</td>
                <td>Conditions générales de vente</td>
                <td>Mentions legales</td>
            </tr>
            <tr>
                <td>©Nassim Barkallah - Victor Jouin - Paul Chevalier 2021</td>
                
            </tr>
        </table>
    </footer>
</div>
<script type="text/javascript" src="js/page.js"></script>
<!-- permet l'affichage du responsiv menu -->
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "Block_Menu") {
            x.className += " responsive";
        } else {
            x.className = "Block_Menu";
        }
    }
</script>