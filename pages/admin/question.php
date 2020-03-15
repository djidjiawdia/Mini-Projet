<?php 
    include_once '../../header.php';

    // unset($_SESSION['questions']);
    // var_dump($_SESSION['questions']);
    // die();

    $repExist = false;

    if(empty($_SESSION['user'])){
        header('location:/mini_projet/pages/admin/connexion.php');
    }
    $welcome = 'Bienvenue '. $_SESSION['user']['prenom'] .' '. $_SESSION['user']['nom'] .' sur la plateforme d\'édition des questionnaires';

    if(isset($_POST['valider'])){
        if(empty($_POST['question'])){
            echo "<p>La question ne doit pas être vide</p>";
        }elseif(empty($_POST['score'])){
            echo "<p>Le score ne doit pas être vide</p>";
        }elseif(!is_numeric($_POST['score'])){ 
            echo "<p>Le score doit être un entier</p>";
        }elseif(isset($_POST['rep']) && empty($_POST['rep'])){
            echo "<p>La réponse ne doit pas être vide</p>";
        }elseif(isset($_POST['nbrRep']) && empty($_POST['nbrRep'])){
            echo "<p>Le nombre de réponses ne doit pas être vide</p>";
        }
        
        if(isset($_POST['nbrRep']) && !empty($_POST['nbrRep'])){
            for($i=1; $i<=$_POST['nbrRep']; $i++){
                $x = 'rep'.$i;
                if(empty($_POST[$x])){
                    $repExist = true;
                }
            }
            if($repExist){
                echo "<p>Les réponses ne doivent pas être vides</p>";
            }elseif(empty($_POST['repC'])){
                echo "<p>Veuillez choisir la ou les réponse(s) correcte(s)</p>";
            }else{
                $_SESSION['questions'][] = $_POST;
            }
        }
        
        if(isset($_POST['rep']) && !empty($_POST['rep'])){
            $_SESSION['questions'][] = $_POST;
        }
    }

?>

<div class="container">
    <div class="content">
        <div class="content-header">
            <p><?= strtoupper($welcome); ?></p>
        </div>
        <form class="form-q" method="post" id="formQ">
            <div class="form-group-q">
                <label for="question">Questions</label>
                <textarea class="form-control-q" name="question" id="question" cols="30" rows="5" ></textarea>
            </div>
            <div class="form-group-q">
                <label for="score">Score</label>
                <input class="form-control-q" type="text" name="score" id="score">
            </div>
            <div class="form-group-q">
                <label for="type">Type</label>
                <select class="form-control-q select" name="type" id="type">
                    <option value="checkbox" selected>Choix multiple</option>
                    <option value="radio">Choix simple</option>
                    <option value="texte">Choix texte</option>
                </select>
            </div>
            <div class="response" id="resp">
                <div class="form-group-q">
                    <label for="nbrRep">Nombre Réponse</label>
                    <input class="form-control-q" type="number" name="nbrRep" id="nbrRep" placeholder="Ex : 3">
                </div>

            </div>
            <button class="btn btn-quest" type="submit" name="valider">Valider</button>
        </form>
    </div>
</div>

<?php include_once '../../footer.php'; ?>
