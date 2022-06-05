<?php

function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connection = new mysqli($servername, $username, $password);

    if($connection->connect_error)
        die("Connection failed: " . $connection->connect_error);

    return $connection;
}

///////////////////////////// accepts username and password
function login($user, $pass) {
    $connection = connect();
    $sql = "select password from playercredentials where username = " . $user . ";";
    $result = $connection->query($sql);

    if ($pass == $result)
        return true;

    $connection->close();
    return false;
}

///////////////////////////// uses username to find ID
function getPlayerID($player) {
    $connection = connect();
    $sql = "select player_id from playercredentials where username = " . $player . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// uses all event data to find ID
function getEventID($start, $end, $location) {
    $connection = conenct();

    $locationID = getLocationID($location);
    if ($locationID == false)
        return false;

    $sql = "select event_id from eventstats where start_date = " . $start . " and end_date = " . $end . " and location_id = " . $locationID . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// updates points in player event stats
/// MUST PASS IN EVENT ID
function addScore($player, $event, $points) {
    $connection = connect();

    $playerID = getPlayerID($player);
    if ($playerID == false)
        return false;

    $sql = "update playereventstats set points = " . $points . " where player_id = " . $playerID . " and event_id = " . $event . ";";

    if ($connection->query($sql) == true) {
        updateTournamentScore($playerID, $points);
        return true;
    }

    $connection->close();
    return false;
}

///////////////////////////// updates overall tournament stats, done automatically in above function
function updateTournamentScore($player, $points) {
    $connection = connect();

    $current = getTournamentScore($player);
    if ($current != false)
        $current += $points;
    else $current = $points;

    $sql = "update playertournamentstats set points = " . $current . " where player_id = " . $player . ";";

    if ($connection->query($sql) == true)
        return true;

    $connection->close();
    return false;
}

///////////////////////////// uses player username to get overall tournament points
function getTournamentScore($player) {
    $connection = connect();

    $playerID = getPlayerID($player);
    if ($playerID == false)
        return false;

    $sql = "select points from playerTournamentStats where player_id = " . $playerID . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// adds new event
function addEvent($id, $start, $end, $location) {
    $connection = connect();

    $locationID = getLocationID($location);
    if ($locationID == false)
        return false;

    $sql = "insert into eventstats values (" . $id . ", " . $start . ", " . $end . ", " . $locationID . ");";

    if ($connection->query($sql) == true)
        return true;

    $connection->close();
    return false;
}

///////////////////////////// uses location name to get location ID
function getLocationID($location) {
    $connection = connect();
    $sql = "select location_id from locationstats where name = " . $location . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// uses event ID to delete event
function removeEvent($start, $end, $location) {
    $connection = connect();
    $eventID = getEventID($start, $end, $location);

    if ($eventID == false)
        return false;

    $sql = "delete from eventstats where event_id = " . $eventID . ";";

    if ($connection->query($sql) == true)
        return true;

    $connection->close();
    return false;
}

///////////////////////////// uses player username to insert image
function uploadImage($player, $media) {
    $connection = connect();
    $playerID = getPlayerID($player);

    if ($playerID == false)
        return false;

    $sql = "update playercredentials set media = " . $media . " where player_id = " . $playerID . ";";

    if ($connection->query($sql) == true)
        return true;

    $connection->close();
    return false;
}

///////////////////////////// uses username and event stats to get player role
function getPlayerRole($player, $start, $end, $location) {
    $connection = connect();
    $playerID = getPlayerID($player);
    $eventID = getEventID($start, $end, $location);

    if ($playerID == false || $eventID == false)
        return false;

    $sql = "select role_id from playerevents where player_id = " . $playerID . " and event_id = " . $eventID . ";";
    $result = $connection->query($sql);

    if ($result != "") {
        $sql = "select description from playerroles where role_id = " . $result . ";";
        $result = $connection->query($sql);
        if ($result != "")
            return $result;
    }

    $connection->close();
    return false;
}

///////////////////////////// pulls event stats for certain location
function pullEventStats($location) {
    $connection = connect();
    $locationID = getLocationID($location);

    if ($locationID == false)
        return false;

    $sql = "select name, par, score from locationstats where location_id = " .$locationID . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// pulls player event stats
function pullPlayerEventStats($player, $start, $end, $location) {
    $connection = connect();
    $playerID = getPlayerID($player);
    $eventID = getEventID($start, $end, $location);

    if ($playerID == false || $eventID == false)
        return false;

    $sql = "select average, birdies, distance_longest, points, position from playereventstats where player_id = " . $playerID . " and event_id = " . $eventID . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}

///////////////////////////// pulls player tournament stats
function pullPlayerTournamentStats($player) {
    $connection = connect();
    $playerID = getPlayerID($player);

    if ($playerID == false)
        return false;

    $sql = "select average, birdies, distance_longest, points, position from playertournamentstats where player_id = " . $playerID . ";";
    $result = $connection->query($sql);

    if ($result != "")
        return $result;

    $connection->close();
    return false;
}
