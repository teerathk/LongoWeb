<?php
require 'php/template.php';
require 'php/mysqli.php';
$title = 'Longo Corporation - Checklist Page';
$description = 'This is the description';
$keywords = 'These are the keywords';
printHead($title, $description, $keywords);
printHeader();

$sql = "select * from checklist where category = 'skirt' order by id asc";
$result = $mysqli->query($sql);

$unsaved_sql = "select * from homesites where category = 'skirt' and crew_leader IS NULL";
$unsaved = $mysqli->query($unsaved_sql);

?>

    <!--==============================content================================-->
    <section id="content">
        <div class="container_12">
            <div class="grid_12">
                <div class="pad-0 border-1">
                    <div id="checkListForm">
                        <div id="section-3" style="display:none;">
                        
                        <h2 class="top-1 p0">In Progress Skirtings</h2>
                        
                        <ul class="sorting">
                            <li onclick="sortSavedItems('asc')">
                                <img src="/images/up.png" />
                            </li>
                            <li onclick="sortSavedItems('desc')">
                                <img src="/images/down.png" />
                            </li>
                        </ul>
                        
                            <ul class="unsaved">
                                <li class="checkboxWrapper">
                                    <span>Site</span> Last Updated
                                <li>
                            </ul>
                            <ul class="unsaved content-section">

                                <?php
                                if ($unsaved->num_rows > 0) {
                                    // output data of each row
                                    while ($skirt = $unsaved->fetch_assoc()) {
                                        ?>
                                        <li class="checkboxWrapper unsavedItemsText">
                                            <span><?= $skirt["homesite"]; ?></span> <?php echo date('m-d-Y', strtotime($skirt["submission"])); ?>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </ul>
                        
                        </div>
                        <div id="section-1">
                            <div class="content-section">
                                <label class="checkboxWrapper">Skirting Site</label>
                                <input type="text" class="home_site" name="home_site">
                                <input type="hidden" id="home_site_id" value="">
                                <input type="hidden" id="category" value="skirt">
                                <button class="savedItems" onclick="$('#section-1, #section-1').hide();$('#section-3').fadeIn();">
                                    In Progress Skirtings
                                </button>
                            </div>
                            <button class="next">
                                Next
                            </button>
                        </div>

                        <div id="section-2">
                        <p class="red-color"<sup>*</sup> Data is Autosaved</p>
                            <h2 class="top-1 p0">Checklist</h2>
                            <div class="content-section">

                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <label class="checkboxWrapper">
                                            <input id="check<?= $row["id"]; ?>" type="checkbox" name="checklist_items[]" value="<?= $row["id"]; ?>">
                                            <?= $row["check_text"]; ?>
                                        </label>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $mysqli->close(); ?>
                            </div>

                            <div class="clear"></div>
                            <div class="left-form">
                                <div>
                                    <label class="checkboxWrapper">Crew leader:</label>
                                    <input type="text" class="crew_leader" name="crew_leader" />
                                </div>
                            </div>
                            <div class="right-form">
                                <div>
                                    <label class="checkboxWrapper">Date:</label>
                                    <input type="date" id="submission" name="submission">
                                </div>
                                <button type="submit" onclick="submitHomesiteChecklist()" class="btn-r">Submit</button>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </section>

<?php printFooter(); ?>