<?php
 include_once('../connection.php');
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM `vocab` WHERE word LIKE '%$search%' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
<div id="vocabulary-box">
    <div>
        <h5 id="word"><?php echo ucfirst($row['word']); ?>/</h5>
        <span id="type"><?php echo ucfirst($row['meaning']); ?></span>
        <span id="bangla">/ <?php echo ucfirst($row['bangla']); ?> /</span>
    </div>

    <?php if (!empty($row['synonym'])): ?>
        <div>
            <span id="synonym-box">SYNONYM</span>
            <span id="synonym"><?php echo ucfirst($row['synonym']); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($row['example'])): ?>
        <p id="example">Example: "<?php echo ucfirst($row['example']); ?>"</p>
    <?php endif; ?>
</div>

<style>#vocabulary-box {
    background-color: #f8f9fa;
    padding: 6px 15px; /* কম জায়গা নেবে */
    border-radius: 6px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    max-width: 700px; /* আগের থেকে ৫০% ছোট */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    border-left: 3px solid #6c757d;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 6px;
}

#word {
    font-weight: bold;
    font-size: 18px; /* Font একটু ছোট করা হয়েছে */
    color: #212529;
    margin-right: 5px;
    display: inline-block;
}

#type {
    font-size: 14px;
    color: #6c757d;
    font-style: italic;
    display: inline-block;
    margin-right: 5px;
}

#bangla {
    font-size: 14px;
    color: #212529;
    display: inline-block;
}

#synonym-box {
    border: 1px solid #6c757d;
    font-size: 12px;
    padding: 1px 4px;
    border-radius: 4px;
    font-weight: bold;
    background-color: #e9ecef;
    margin-right: 4px;
}

#synonym {
    font-size: 14px;
    color: #212529;
}

#example {
    font-size: 18px;
    color:red;
    font-style: italic;
    width: 100%;
    text-align: left;
    margin-top: 5px;
}

</style>

        <?php
        }
    } else {
        echo "<p>No results found</p>";
    }
}

$conn->close();
?>
