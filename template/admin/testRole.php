<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    th,td{
        width: 100px;height: 30px;text-align: center;
    }
</style>
<table>
    <tr>
        <th>lid</th>
        <th>lname</th>
    </tr>

{foreach $result3 as $v}
    <tr>
        <td>{$v["lid"]}</td>
        <td>{$v["lname"]}</td>
    </tr>
{/foreach}
</table>
{$res}
</body>
</html>