<?php
    function getStaticQueries() {
    $queries = array();
    
    $queries['listBattles'] = array();
    $queries['listBattles']['title'] = "List of Battles";
    $queries['listBattles']['sql'] = "SELECT b.start_date, b.end_date, b.title, b.location FROM battle as b";
   
    $queries['longestBattle'] = array();
    $queries['longestBattle']['title'] = "Longest Battle";
    $queries['longestBattle']['sql'] = "SELECT b.start_date, b.end_date, b.title, b.location, DATEDIFF(b.end_date, b.start_date) as num_days FROM battle as b WHERE DATEDIFF(b.end_date, b.start_date) IN (SELECT MAX(DATEDIFF(b.end_date, b.start_date)) as num_days FROM battle as b)";
   
    $queries['shortestBattle'] = array();
    $queries['shortestBattle']['title'] = "Shortest Battle";
    $queries['shortestBattle']['sql'] = "SELECT b.start_date, b.end_date, b.title, b.location, DATEDIFF(b.end_date, b.start_date) as num_days FROM battle as b WHERE DATEDIFF(b.end_date, b.start_date) IN (SELECT MIN(DATEDIFF(b.end_date, b.start_date)) as num_days FROM battle as b)";
   
    $queries['mostForces'] = array();
    $queries['mostForces']['title'] = "List of Battles by Number of Soldiers";
    $queries['mostForces']['sql'] = "SELECT b.start_date, b.end_date, b.title, b.location, forces.force_size FROM battle as b, (SELECT p.battle_id as bid, SUM(p.force_size) as force_size FROM participates_in_battle as p GROUP BY p.battle_id) as forces WHERE forces.bid  = b.bid AND forces.force_size IS NOT NULL ORDER BY forces.force_size DESC";
    
    $queries['mostParticipants'] = array();
    $queries['mostParticipants']['title'] = "List of Battles by Number of Participants";
    $queries['mostParticipants']['sql'] = "SELECT b.title, b.location, b.start_date, b.end_date, participants.participant_count FROM battle as b, (SELECT p.battle_id, COUNT(p.participant_id) as participant_count FROM participates_in_battle as p GROUP BY p.battle_id) as participants WHERE participants.battle_id = b.bid ORDER BY participants.participant_count DESC";
    
    $queries['highCasualtiesLoss'] = array();
    $queries['highCasualtiesLoss']['title'] = "Losing Battle With Highest Number of Casualties";
    $queries['highCasualtiesLoss']['sql'] = "SELECT p.name, b.title, b.location, b.start_date, b.end_date, pib.num_casualties FROM participates_in_battle as pib, participant as p, battle as b WHERE p.pid = pib.participant_id AND b.bid = pib.battle_id AND pib.status = 'lose' AND pib.num_casualties = (SELECT MAX(pib.num_casualties) FROM participates_in_battle as pib, participant as p WHERE status = 'lose')";
    
    $queries['highCasualtiesWin'] = array();
    $queries['highCasualtiesWin']['title'] = "Winning Battle With Highest Number of Casualties";
    $queries['highCasualtiesWin']['sql'] = "SELECT p.name, b.title, b.location, b.start_date, b.end_date, pib.num_casualties FROM participates_in_battle as pib, participant as p, battle as b WHERE p.pid = pib.participant_id AND b.bid = pib.battle_id AND pib.status = 'win' AND pib.num_casualties = (SELECT MAX(pib.num_casualties) FROM participates_in_battle as pib, participant as p WHERE status = 'win')";
   
    $queries['lowCasualtiesLoss'] = array();
    $queries['lowCasualtiesLoss']['title'] = "Losing Battle With Lowest Number of Casualties";
    $queries['lowCasualtiesLoss']['sql'] = "SELECT p.name, b.title, b.location, b.start_date, b.end_date, pib.num_casualties FROM participates_in_battle as pib, participant as p, battle as b WHERE p.pid = pib.participant_id AND b.bid = pib.battle_id AND pib.status = 'lose' AND pib.num_casualties = (SELECT MIN(pib.num_casualties) FROM participates_in_battle as pib, participant as p WHERE status = 'lose')";
    
    $queries['lowCasualtiesWin'] = array();
    $queries['lowCasualtiesWin']['title'] = "Winning Battle With Lowest Number of Casualties";
    $queries['lowCasualtiesWin']['sql'] = "SELECT p.name, b.title, b.location, b.start_date, b.end_date, pib.num_casualties FROM participates_in_battle as pib, participant as p, battle as b WHERE p.pid = pib.participant_id AND b.bid = pib.battle_id AND pib.status = 'win' AND pib.num_casualties = (SELECT MIN(pib.num_casualties) FROM participates_in_battle as pib, participant as p WHERE status = 'win')";
   
    $queries['numWin'] = array();
    $queries['numWin']['title'] = "Participant with most number of battles with a win outcome";
    $queries['numWin']['sql'] = "SELECT p.name, COUNT(p.name) as num_other FROM participant as p, participates_in_battle as pib WHERE pib.participant_id = p.pid AND pib.status = 'win' GROUP BY p.name ORDER BY num_other DESC LIMIT 1";
   
    $queries['numLose'] = array();
    $queries['numLose']['title'] = "Participant with most number of battles with lose outcome";
    $queries['numLose']['sql'] = "SELECT p.name, COUNT(p.name) as num_other FROM participant as p, participates_in_battle as pib WHERE pib.participant_id = p.pid AND pib.status = 'lose' GROUP BY p.name ORDER BY num_other DESC LIMIT 1";
    
    $queries['numOther'] = array();
    $queries['numOther']['title'] = "Participant with most number of battles with an 'other' outcome";
    $queries['numOther']['sql'] = "SELECT p.name, COUNT(p.name) as num_other FROM participant as p, participates_in_battle as pib WHERE pib.participant_id = p.pid AND pib.status = 'other' GROUP BY p.name ORDER BY num_other DESC LIMIT 1";
    
    $queries['numTogether'] = array();
    $queries['numTogether']['title'] = "Number of Battles that two Participants Fought on Same Side";
    $queries['numTogether']['sql'] = "SELECT p1.name as 'Participant 1', p2.name as 'Participant 2', COUNT(p1.battle_id) as 'Number of Battles Fought Together' FROM (SELECT * FROM (participates_in_battle as pib LEFT JOIN participant as p ON p.pid = pib.participant_id)) as p1, (SELECT * FROM (participates_in_battle as pib LEFT JOIN participant as p ON p.pid = pib.participant_id)) as p2 WHERE p1.pid < p2.pid AND p1.battle_id = p2.battle_id AND p1.aid = p2.aid GROUP BY p1.name, p2.name";
    
    return $queries;
    }
    
    function getDynamicQueries($db) {
        $queries = array();
        $queries['byLocation'] = array();
        $queries['byLocation']['userInput'] = mysqli_real_escape_string($db, $_POST['location']);
        $queries['byLocation']['title'] = "List of Battles in Location: " .  $queries['byLocation']['userInput'];
        $queries['byLocation']['sql'] = "SELECT b.start_date, b.end_date, b.title, b.location FROM battle as b WHERE b.location LIKE '%". $queries['byLocation']['userInput'] ."%'";
       
        $queries['winsByParticipant'] = array();
        $queries['winsByParticipant']['userInput'] = mysqli_real_escape_string($db, $_POST['participant1']);
        $queries['winsByParticipant']['title'] = "Number of Wins per Participant";
        $queries['winsByParticipant']['sql'] = "SELECT p.name, COUNT(p.pid) as num_wins FROM participant as p, participates_in_battle as pib WHERE pib.participant_id = p.pid AND p.pid = ".$queries['winsByParticipant']['userInput']. " AND pib.status = 'win' GROUP BY p.name";
       
        $queries['lossesByParticipant'] = array();
        $queries['lossesByParticipant']['userInput'] = mysqli_real_escape_string($db, $_POST['participant2']);
        $queries['lossesByParticipant']['title'] = "Number of Losses per Participant";
        $queries['lossesByParticipant']['sql'] = "SELECT p.name, COUNT(p.pid) as num_wins FROM participant as p, participates_in_battle as pib WHERE pib.participant_id = p.pid AND p.pid = ".$queries['lossesByParticipant']['userInput']. " AND pib.status = 'lose' GROUP BY p.name";
        
        $queries['battlesByParticipant'] = array();
        $queries['battlesByParticipant']['userInput'] = mysqli_real_escape_string($db, $_POST['participant3']);
        $queries['battlesByParticipant']['title'] = "Battles per Participant";
        $queries['battlesByParticipant']['sql'] = "SELECT p.name, b.title, b.location, pib.num_casualties, pib.status FROM participant as p, participates_in_battle as pib, battle as b WHERE pib.participant_id = p.pid AND p.pid = ".$queries['winsByParticipant']['userInput']. " AND pib.battle_id = b.bid";
        
        return $queries;
    }
?>