<?php

2

error_reporting(0);

3

4

Class Bom {

5

6

	public $no;

7

public $type;

8

9

	public function sendC($url, $page, $params) {

10

11

$ch = curl_init(); 

12

curl_setopt ($ch, CURLOPT_URL, $url.$page); 

13

curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 

14

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 

15

16

if(!empty($params)) {

17

curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);

18

curl_setopt ($ch, CURLOPT_POST, 1); 

19

}

20

21

curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

22

curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

23

curl_setopt ($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

24

curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);

25

26

$headers = array();

27

$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';

28

$headers[] = 'X-Requested-With: XMLHttpRequest';

29

30

curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers); 

31

//curl_setopt ($ch, CURLOPT_HEADER, 1);

32

$result = curl_exec ($ch);

33

curl_close($ch);

34

return $result;

35

36

}

37

38

private function getStr($start, $end, $string) {

39

if (!empty($string)) {

40

$setring = explode($start,$string);

41

$setring = explode($end,$setring[1]);

42

return $setring[0];

43

}

44

}

45

46

47

public function Verif()

48

{

49

$url = "https://www.tokocash.com/oauth/otp";

50

$no = $this->no;

51

$type = $this->type;

52

if ($type == 1) {

53

$data = "msisdn={$no}&accept=";

54

}elseif ($type == 2) {

55

$data = "msisdn={$no}&accept=call";

56

}

57

$send = $this->sendC($url, null, $data);

58

// echo $send;

59

if (preg_match('/otp_attempt_left/', $send)) {

60

print('Ngamen Sukses!★');

61

} else {

62

print('Gagal Dikirim!★');

63

}

64

}

65

66

67

}

68












