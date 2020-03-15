<?php
    include_once '../../header.php';

    if(empty($_SESSION['joueur'])){
        header('location:/mini_projet/pages/joueur/connexion.php');
    }

    $tabs = [];
    //$_SESSION['nbrQuestions'] = 5;
    // var_dump($_SESSION['questions']);
    // die();
    if(!empty($_SESSION['questions']) && !empty($_SESSION['nbrQuestions'])){
        $rand = array_rand($_SESSION['questions'], $_SESSION['nbrQuestions']);
        for($i=0; $i<$_SESSION['nbrQuestions']; $i++){
            $tabs[] = $_SESSION['questions'][$rand[$i]];
        }
    }
    //var_dump($tabs);

    $welcome = 'Bienvenue ' . $_SESSION['joueur']['prenom'] .' '. $_SESSION['joueur']['nom'] . ' sur la plateforme de réponses aux QCM';
?>

<div class="container">
    <div class="content">
        <div class="content-header">
            <p><?= strtoupper($welcome); ?></p>
        </div>
        <form class="form-rep" method="post" id="repForm">
            <div class="tabs">
                <?php foreach($tabs as $k => $tab): ?>
                <div class="tab">
                    <h2>Question <?= ($k+1).'/'.$_SESSION['nbrQuestions'] ?></h2>
                    <textarea class="form-control qst-area" readonly><?= (!empty($tab))?$tab['question'] : ''; ?></textarea>
                    <h2>Nombre de point: <?= $tab['score'] ?> pts</h2>
                    <div class="res-group">
                        <?php if($tab['type'] === 'texte'){ ?>
                            <div class="form-group-q">
                                <label for="repText">Réponse</label>
                                <input class="form-control-q" id="repText" type="<?= $tab['type'] ?>" name="repText">
                            </div>
                        <?php }else{ for($i=1; $i<=$tab['nbrRep']; $i++){ ?>
                            <div class="input-res">
                                <label class="labelCheck" for="resp"><?= 'Rep '. $i .':<span>' . htmlentities($tab['rep'.$i], ENT_QUOTES) . '</span>' ?></label>
                                <input class="inputCheck" id="resp" value="<?= 'rep'.$i ?>" type="<?= $tab['type'] ?>" name="resp[]">
                            </div>
                        <?php }} ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="group-btn-resp">
                    <div>
                        <button class="btn-res btn-disable" name="prec" id="prec" onclick="prev()">Précédent</button>
                        <button class="btn-res btn-active" id="suiv" onclick="next()">Suivant</button>
                    </div>
                </div>
                <div class="steps">
                    <?php for($i=0; $i<$_SESSION['nbrQuestions']; $i++){ ?>
                        <span class="step"></span>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        // pass PHP variable declared above to JavaScript variable
        const tabs = <?php echo json_encode($tabs) ?>;
    </script>
</div>

<?php require_once '../../footer.php'; ?>