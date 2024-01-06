<?php  
if($_SESSION['is_admin'] == false){
    $navbarPages = [
        ['label' => 'Browse', 'link' => '/browse'],
        ['label' => 'Songs', 'link' => '/browse/song'],
        ['label' => 'Albums', 'link' => '/browse/album'],
        ['label' => 'Artists', 'link' => '/browse/artist'],
        ['label' => 'All Podcaster', 'link' => '/all-podcasters'],
        ['label'=> 'My Subscription', 'link'=> '/subscribed-podcasters'],
    ];
}else{
    $navbarPages = [
        ['label' => 'Browse', 'link' => '/browse'],
        ['label' => 'Songs', 'link' => '/browse/song'],
        ['label' => 'Albums', 'link' => '/browse/album'],
        ['label' => 'Artists', 'link' => '/browse/artist'],
    ];
    
}

?>

<navbar>

    <div id="logo-container">
        <img src="../../../public/img/spotiplay.svg" alt="spotiplay logo"> </img>
        <h1>Spotiplay</h1>
        
    </div>
    <?php  foreach($navbarPages as $page):   ?>
        <div class = "Tab">
            <a href="<?php echo $page['link']; ?>"> <?php echo $page['label']; ?></a>
        </div>

    <?php endforeach; ?>

</navbar>