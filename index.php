<?php
$title = 'Todo List';
$name = '';
// $todos = [
//     ['id' => 1, 'name' => 'shiny star'],
//     ['id' => 2, 'name' => 'green shell'],
//     ['id' => 3, 'name' => 'chick']
// ];

$todos_data = json_decode(file_get_contents(('./data.json')), true);
$todos = $todos_data['todos'];


// Add
if (isset($_POST['name'])) {
    // print_r($_POST);
    $name = $_POST['name'];
    array_push($todos, ['id' => count($todos) + 1, 'name' => $name]);
    
    $todos_data['todos'] = $todos;
    file_put_contents('data.json', json_encode($todos_data));
    // print_r($todos);
}

$del = null;
// Delete
if (isset($_POST['delete'])) {

    $id = $_POST['id_to_del'];
    $del = array_slice($todos, $id - 1, 1);

    var_dump($todos);
    for ($i = 0; $i < count($todos); $i++) {
        if ($todos[$i]['id'] == $id) {
            array_splice($todos,$i,1);
        } 
    }
    
    $todos_data['todos'] = $todos;
    file_put_contents('data.json', json_encode($todos_data));
    
    // unset($todos_data);
    // for ($i = 0; $i < count($todos); $i++) {
    //     if ($todos[$i] != $del[0]) {
    //         array_push($todos, ['id' => $todos[$i]['id'], 'name' => $todos[$i]['name']]);
    //     }
    // }

}

$edit = null;
// Edit
if (isset($_POST['edit'])) {

    $edit = $_POST['name_to_edit'];
    $id = $_POST['id_to_edit'];
    print_r($edit);
    print_r($id);

    for ($i = 0; $i < count($todos); $i++) {
        if ($todos[$i]['id'] == $id) {
            $todos[$i]['name'] = $edit;
            break;
        }
    }

    $todos_data['todos'] = $todos;
    file_put_contents('data.json', json_encode($todos_data));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php todo</title>
</head>

<body>
    <center>
        <h1>
            <?php echo $title; ?>
        </h1>

        <!-- ADD form -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h2>What do you want to do ?</h2>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <button type="submit" name="submit">Add</button>
        </form>

        <!-- The Todos array -->
        <?php foreach ($todos as $todo) { ?>
            <h2>
                <?php echo htmlspecialchars($todo['name']); ?>
                <?php echo htmlspecialchars($todo['id']); ?>

                <!-- Delete -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="id_to_del" value="<?php echo $todo['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>

                <!-- Edit -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="name_to_edit" value="<?php echo $todo['name']; ?>">
                    <input type="hidden" name="id_to_edit" value="<?php echo $todo['id']; ?>">
                    <button type="submit" name="edit">Edit</button>
                </form>
            </h2>
        <?php } ?>

    </center>
</body>

</html>