
<?php

2

3

// Start Session

4

session_start();

5

6

// Database connection

7

require __DIR__ . '/config/db_connection.php';

8

$db = DB();

9

10

// Application Ngamen

11

require __DIR__ . '/library/library.php';

12

$app = ngamen yukk($db);

13

14

require_once __DIR__ . '/GoogleAuthenticator/GoogleAuthenticator.php';

15

$pga = new PHPGangsta_GoogleAuthenticator();

16

$secret = $pga->createSecret();

17

18

$register_error_message = '';

19

20

// check Register request

21

if (!empty($_POST['btnRegister'])) {

22

if ($_POST['name'] == "") {

23

$register_error_message = 'Name field is required!';

24

} else if ($_POST['email'] == "") {

25

$register_error_message = 'Email field is required!';

26

} else if ($_POST['username'] == "") {

27

$register_error_message = 'Username field is required!';

28

} else if ($_POST['password'] == "") {

29

$register_error_message = 'Password field is required!';

30

} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

31

$register_error_message = 'Invalid email address!';

32

} else if ($app->isEmail($_POST['email'])) {

33

$register_error_message = 'Email is already in use!';

34

} else if ($app->isUsername($_POST['username'])) {

35

$register_error_message = 'Username is already in use!';

36

} else {

37

$user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $secret);

38

// set session and redirect user to the profile page

39

$_SESSION['user_id'] = $user_id;

40

header("Location: confirm_google_auth.php");

41

}

42

}

43

?>

44

<!doctype html>

45

<html lang="en">

46

<head>

47

<meta charset="UTF-8">

48

<title>OTP - MFA/2FA BYPASS : Registration</title>

49

<!-- Latest compiled and minified CSS -->

50

<link rel="stylesheet" href="css/bootstrap.min.css">

51

</head>

52

<body>

53

54

<div class="container">

55

<div class="row jumbotron">

56

<div class="col-md-12">

57

<h2>

58

<center>MULTI-FACTOR BYPASS NGAMEN</center>

59

</h2>

60

<p>

61

<center>Note: This is a Vulnerable Multi-Factor Application</center>

62

</p>

63

</div>

64

</div>

65

<div class="row">

66

<div class="col-md-5 col-md-offset-3 well">

67

<h4>Register</h4>

68

<?php

69

if ($register_error_message != "") {

70

echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';

71

}

72

?>

73

<form action="registration.php" method="post">

74

<div class="form-group">

75

<label for="">Name</label>

76

<input type="text" name="name" class="form-control"/>

77

</div>

78

<div class="form-group">

79

<label for="">Email</label>

80

<input type="email" name="email" class="form-control"/>

81

</div>

82

<div class="form-group">

83

<label for="">Username</label>

84

<input type="text" name="username" class="form-control"/>

85

</div>

86

<div class="form-group">

87

<label for="">Password</label>

88

<input type="password" name="password" class="form-control"/>

89

</div>

90

<div class="form-group">

91

<input type="submit" name="btnRegister" class="btn btn-primary" value="Register"/>

92

</div>

93

</form>

94

<div class="form-group">

95

Click here to <a href="index.php">Login</a> if you have already registered your account.

96

</div>

97

</div>

98

</div>

99

</div>

100

101

</body>

102

</html>















