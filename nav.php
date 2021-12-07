<?php
if (!isset($menus)) {
    $menus = [];
}
?>

<div class="sidebar-container" id="mySidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <div class="sidebar-logo">
        To-Do List
    </div>
    <ul class="sidebar-navigation">
        <!--
        <li class="header">Navigation</li>
        <li>
            <a href="about.php">
                <i class="fa fa-users" aria-hidden="true"></i> About
            </a>
        </li>
        -->
        <p class="header">Lists</p>
            <form action="savelist.php" method="post">
                <input type="text" placeholder="Enter list name" id="createnewlist" name="listname" style="text-align: center" required>
                <button type="submit" name="submit" id="enabler"><i class="fa fa-plus" aria-hidden="true"></i>Create list</button>
            </form>
        <?php
        foreach ($menus as $number => $menu) {
            ?>
            <li>
                <a href="index.php?id=<?php echo $menu['idlist']; ?>">
                    <i class="fa fa-tasks" aria-hidden="true"></i> <?php echo $menu["list_name"]; ?>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>

<style>

    .closebtn{
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        color: white;
        text-decoration: none;
    }

    .closebtn:hover{
        color: white;
        text-decoration: none;
    }

    .openbtn{
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 15px;
        border: none;
    }

    .openbtn:hover{
        background-color: #444;
    }

    #createnewlist {
        background-color: #1a1a1a;
        color: #fff;
        border: none;
        text-align: center;
        width: 100%;

    }

    #enabler{
        padding: 10px 15px 10px 30px;
        display: block;
        color: #fff;
        text-align: left;
        text-decoration: none;
        background: none;
        border: none;
        width: 100%;
    }


</style>

<script>

    function openNav()
    {
        document.getElementById("mySidebar").style.width = "220px";
        document.getElementById("main").style.marginLeft = "220px";
    }

    function closeNav()
    {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }

</script>