 <?php
$players = array(
    "Virat Kohli" => "Batsman",
    "Jasprit Bumrah" => "Bowler",
    "MS Dhoni" => "Batsman",
    "Sachin Tendulkar" => "Batsman",
    "KL Rahul" => "Bowler",
);
?>
<html>
<head>
<title>Indian Cricket Players</title>
<style>
   table {
        width: 50%;
        margin: 20px auto;
        border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: lavender;
        }
    </style>
</head>
<body>
<h2 style="text-align: center;">List of Indian Cricket Players</h2>

<table>
<tr>
<th>No.</th>
<th>Player Name</th>
<th>Position</th>
</tr>

<?php
$index = 1;
foreach ($players as $player => $position) {
   echo "<tr>";
   echo "<td>" . $index++ . "</td>";
   echo "<td>" . $player . "</td>";
   echo "<td>" . $position . "</td>";
   echo "</tr>";
  }
 ?>
</table>
</body>
</html>

