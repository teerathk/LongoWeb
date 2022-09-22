<?php

include 'location.php';

class locations {
    var $allLocations = array();
    
    /**
     * This function add a single location object to the class variable $allLocations
     * @param location $singleLocation an location object
     */
    function addLocationtoArray(location $singleLocatioin) {
        //This function handles adding a single employee, and will be called for each tv within a given "set"
        $this ->allLocations[count($this ->allLocations) + 1] = $singleLocatioin;
    }
    
    function printLocationOptions($select){
        print '<option value="all">All Locations</option>';
        foreach ($this->allLocations as $theLocation){
            $dbID = $theLocation->getDBID();
            $locationName = $theLocation->getName();
            print '<option value="' . $dbID . '"';
            if($select==$dbID){
                print ' selected="selected"';
            }
                    
                    
            print '>' . $locationName . '</option>';
    }
    }
    
    function printLocationList(){
           print '<table class="searchTable">
                <tr class="searchHeaderRow">
        <td width="150px">
            <span class="searchHeader">
                Location Id
            </span>
        </td>
        <td width="400px">
            <span class="searchHeader">
                Location Name
            </span>
        </td>
        <td width="250px">
            <span class="searchHeader">
                
            </span>
        </td>
       
        </tr>';
        
        $totalCount = count($this->allLocations);
        $i = 1;
        foreach($this->allLocations as $theLocation){
            $e = new location();
            $e = $theLocation;
            if($i&1) {
                $rowClass = 'oddRow';
            }
            else{
                $rowClass = 'evenRow';
            }
            
            $id = $e->getDBID();
            $name = $e->getName();

            print '<tr class="' . $rowClass . '">';
            print '<td>' . $id . '</td>';
            print '<td>' . $name . '</td>';
            print '<td><a class="button" href="updateLocation.php?locationId=' . $id . '"> Update </a>
                    <a class="button" href="../php/updateLocation.php?delid=' . $id . '" onclick="if( !confirm(\'Are you sure you want to delete this location? Any Jobs associated with this location will be deleted as well. \') ) { return false; }" title=""> Delete </a></td>';
            print '</tr>';
                    
            if($i == $totalCount){
                print '</table>';
            }
            else{
                $i = $i + 1;
            }
        }
        print '</ul>';
    }
    
    
}
?>