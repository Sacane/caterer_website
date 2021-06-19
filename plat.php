<?php
    session_start();
    
     function array_doublon($array){
         /* fonction renvoyant un taleau ne contenant que les doublons présent dans le taleau pris en paramètre */
       if (!is_array($array)) 
           return false; 

       $r_valeur = Array();

       $array_unique = array_unique($array); 

       if (count($array) - count($array_unique)){ 
           for ($i=1; $i<count($array); $i++) {
               if (!array_key_exists($i, $array_unique)) 
                   $r_valeur[] = $array[$i];
           } 
       } 
       return $r_valeur;
     }

    if(empty($_POST['label'])){
        header('location: choix.php');
        exit;
    }
    $array_aller=array();
    $label=array();
    $plat_label=array();
    $allergene=array();
    $res_aller=array();
    $compt=1;
    $cmpt=0;
    $cmpt_aller=1;
    $cmptPlat=1;
    include('connexion.php');
    if(!empty($_POST['label'])){   
        $lab=$cnx->query('SELECT * from label');
        foreach($_POST['label'] as $valeur){
            $label[$valeur]=$valeur;
        }
        $req_plat=$cnx->query('SELECT id_plat, nom_plat FROM plat');
        if($compt>3){
            $requete=$cnx->query('SELECT * FROM plat');
            foreach($requete as $plat){
                $plat_label[$plat['id_plat']]=$plat['nom_plat'];
            }
        }
        else{
            foreach($label as $cle => $value){
                $requete=$cnx->prepare('SELECT DISTINCT nom_plat FROM plat NATURAL JOIN composer NATURAL JOIN ingredient WHERE id_ingre IN ( SELECT DISTINCT id_ingre FROM ingredient NATURAL JOIN labeliser NATURAL JOIN label WHERE id_label = :num)');
                $requete->execute(array(':num'=>$cle));
                foreach($requete as $plat){
                    $plat_label[$cmpt]=$plat['nom_plat'];
                    $cmpt+=1;
                }
            }
        }
    }
    if(!empty($_POST['allergene'])){
        foreach($_POST['allergene'] as $val_aller){
            $allergene[$val_aller]=$val_aller;
        }
        
        foreach($allergene as $key => $valeur){
            $request=$cnx->prepare('SELECT nom_plat FROM plat WHERE nom_plat NOT IN (SELECT nom_plat FROM plat NATURAL JOIN composer WHERE id_ingre IN (SELECT id_ingre FROM ingredient NATURAL JOIN contenir WHERE id_allergene = :num))');
            $request->execute(array(':num'=>$key));
            foreach($request as $plat_aller){
                $array_aller[$cmptPlat]=$plat_aller['nom_plat'];
                $cmptPlat+=1;
                
            }
            
        }
        if(count($allergene)>1){
            $res_aller=array_doublon($array_aller);
        }
        else{
            $res_aller=$array_aller;
        }
    }

    else{
        $request=$cnx->query('SELECT * FROM plat');
        foreach($request as $plat_aller){
            $res_aller[$cmptPlat]=$plat_aller['nom_plat'];
            $cmptPlat+=1;
        }
    }
    
    $unique_lab=array_unique($plat_label);
    $unique_all=array_unique($res_aller);
    $result=array_intersect($unique_lab, $unique_all);
    $res=array_unique($result);
    $cnx=null;
?>

<html>
<head>
    <meta charset="utf-8">
    <title>choix</title>
    <link rel="stylesheet" href="traiteur.css">
</head>
<body>
    <h1><h1> Bonjour Mr/Mme <?= htmlspecialchars($_SESSION['nom']) ?> !</h1>
    <h2> Nous vous avons séléctionner les plats qui correspondent à vos demande :</h2>
    <form method="POST" action="validation.php">
    Choix du plat : <select name ='plat'>
    <option value="plat" selected="selected">Selectionner un plat</option>
    <?php foreach($res as $index => $value){?>
        <option value="<?php echo $value;?>"><?php echo $value?></option>
    <?php } ?>
    </select>
    <br><br>

    <input type='submit' name='choix' value='Annuler'>
    <input type='submit' name = 'choix' value='Continuer'>
    <input type='submit' name= 'choix' value='Valider'>
    <input type='submit' name='choix' value='Abandonner'>
    <br><br>
    <address>("Annuler" signifie que vous annulez le choix actuel, si vous cliquez dessus nous vous renverrons vers le choix des labels et allergenes).</address><br>
    <address>("Continuer vous permet de continuer vos achats")</address></br>
    <address>("Valider" vous permet de valider votre commande)</address><br>
    <address>("Abandonner" vous permet d'abandonner la totalité de votre commande en cours)</address>
    </form>
    <?php 
    include('footer.html');
    ?>
</body>
</html>
