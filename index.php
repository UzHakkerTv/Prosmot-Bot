<?php
/*
☆《Alpha Team》☆
▪مرجع بهترین و جدیدترین سورس های ربات
▪مرجع تیکه کد های کاربردی
▪مرجع قالب و افزونه سایت
° Telegram.me/TmAlpha
° @TmAlpha
*/
unlink(error_log);
$load = sys_getloadavg();
$API_KEY = "token";
define('API_KEY',$API_KEY);

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function numberformat($str, $sep = ',')
{
    $result = '';
    $c = 0;
    $num = strlen("$str");
    for ($i = $num - 1; $i >= 0; $i--) {
        if ($c == 3) {
            $result = $sep . $result;
            $result = $str[$i] . $result;
            $c = 0;
        } else {
            $result = $str[$i] . $result;
        }
        $c++;
    }
    return $result;
}
function sendmessage($chat_id, $text, $mode, $disable_web_page_preview){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'disable_web_page_preview'=>$disable_web_page_preview,
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function getFileList($folderName, $fileType = "")
{
    if (substr($folderName, strlen($folderName) - 1) != "/") {
        $folderName .= '/';
    }

	$c=0;
    foreach (glob($folderName . '*' . $fileType) as $filename) {
        if (is_dir($filename)) {
            $type = 'folder';
        } else {
            $type = 'file';
        }
        $c++;
    }
	return $c;

}

function create_zip($files = array(),$destination = '') {
    if(file_exists($destination)) { return false; }
    $valid_files = array();
    if(is_array($files)) {
        foreach($files as $file) {
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    if(count($valid_files)) {
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        foreach($valid_files as $file) {
            $zip->addFile($file,$file);
        }
        $zip->close();
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}
	function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}

function SendAudio($chatid,$audio,$keyboard,$caption,$sazande,$title){
	bot('SendAudio',[
	'chat_id'=>$chatid,
	'audio'=>$audio,
	'caption'=>$caption,
	'performer'=>$sazande,
	'title'=>$title,
	'reply_markup'=>$keyboard
	]);
	}
	function SendDocument($chatid,$document,$keyboard,$caption){
	bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
	function SendSticker($chatid,$sticker,$keyboard){
	bot('SendSticker',[
	'chat_id'=>$chatid,
	'sticker'=>$sticker,
	'reply_markup'=>$keyboard
	]);
	}
	function SendVideo($chatid,$video,$caption,$keyboard,$duration){
	bot('SendVideo',[
	'chat_id'=>$chatid,
	'video'=>$video,
        'caption'=>$caption,
	'duration'=>$duration,
	'reply_markup'=>$keyboard
	]);
	}
	function SendVoice($chatid,$voice,$keyboard,$caption){
	bot('SendVoice',[
	'chat_id'=>$chatid,
	'voice'=>$voice,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
	function SendContact($chatid,$first_name,$phone_number,$keyboard){
	bot('SendContact',[
	'chat_id'=>$chatid,
	'first_name'=>$first_name,
	'phone_number'=>$phone_number,
	'reply_markup'=>$keyboard
	]);
	}
	/* Tabee Send Chat Action */
function SendChatAction($chatid,$action){
	bot('sendChatAction',[
	'chat_id'=>$chatid,
	'action'=>$action
	]);
	}
	/* Tabee Kick Chat Member */
function KickChatMember($chatid,$user_id){
	bot('kickChatMember',[
	'chat_id'=>$chatid,
	'user_id'=>$user_id
	]);
	}
	/* Tabee Leave Chat */
function LeaveChat($chatid){
	bot('LeaveChat',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat */
function getChat($idchat){
	$json=file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChat?chat_id=".$idchat);
	$data=json_decode($json,true);
	return $data["result"]["first_name"];
}
	/* Tabee Get Chat Members Count */
function GetChatMembersCount($chatid){
	bot('getChatMembersCount',[
	'chat_id'=>$chatid
	]);
	}
	/* Tabee Get Chat Member */
function GetChatMember($chatid,$userid){
	$truechannel = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChatMember?chat_id=".$chatid."&user_id=".$userid));
	$tch = $truechannel->result->status;
	return $tch;
	}
	/* Tabee Answer Callback Query */
function AnswerCallbackQuery($callback_query_id,$text,$show_alert){
	bot('answerCallbackQuery',[
        'callback_query_id'=>$callback_query_id,
        'text'=>$text,
		'show_alert'=>$show_alert
    ]);
	}
function sendphoto($chat_id, $photo, $action){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'action'=>$action
	]);
	}
	function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
#-----------------------------

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
mkdir("data/$from_id");
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $update->message->text;
$oghab = file_get_contents("data/$from_id/com.txt");
$ADMIN = ' ';
$user = file_get_contents("Member.txt");
$tc = $update->message->chat->type;
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bottoken/getChatMember?chat_id=Idchannel&user_id=".$from_id));
$tch = $truechannel->result->status;
$first = $update->message->from->first_name;
$tedad = file_get_contents('data/'.$from_id."/golds.txt");
@$list = file_get_contents("Member.txt");
@$wait = file_get_contents("data/$from_id/wait.txt");
@$coin = file_get_contents("data/$from_id/golds.txt");
@$sof = file_get_contents("data/sofs.txt");
$channel = "idchannel";
$on = file_get_contents("on.txt");
#-------------------------
if ($on == "off" && $from_id != "$ADMIN") {

bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"❗️ربات برای چند ساعت آینده خاموش شده است...
🌹 لطفا دقایقی دیگر دوباره امتحان کنید",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
	}else{
   if($text == '←'){
	   file_put_contents("data/$from_id/com.txt","none");
  bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔥 به منوی اصلی خوش آمدید :",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
	file_put_contents("data/$from_id/com.txt","none");
  }
/*
☆《Alpha Team》☆
▪مرجع بهترین و جدیدترین سورس های ربات
▪مرجع تیکه کد های کاربردی
▪مرجع قالب و افزونه سایت
° Telegram.me/TmAlpha
° @TmAlpha
*/
  
   if(preg_match('/^\/([Ss]tart)(.*)/',$text)){
   
	preg_match('/^\/([Ss]tart)(.*)/',$text,$match);
	$match[2] = str_replace(" ","",$match[2]);
	$match[2] = str_replace("\n","",$match[2]);
	if($match[2] != null){
	if (strpos($user , "$from_id") == false){
	if($match[2] != $from_id){
	if (strpos($tedad , "$from_id") == false){
	$txxt = file_get_contents('data/'.$match[2]."/golds.txt");
    $pmembersid= explode("\n",$txxt);
    if (!in_array($from_id,$pmembersid)){
      $deee = file_get_contents('data/'.$match[2]."/golds.txt");
		file_put_contents('data/'.$match[2]."/golds.txt",$deee+3);
		
		bot('sendmessage',[
	'chat_id'=>$match[2],
	'text'=>"🙌 یه نفر با لینکت عضو ربات شد و 3 تا الماس جایزه گرفتی😻️",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
    }
	}
	}
	}
	}
  
if (!file_exists("data/$from_id/com.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/com.txt","none");
        file_put_contents("data/$from_id/golds.txt","10");
        $myfile2 = fopen("Member.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
		file_put_contents("data/$from_id/com.txt","none");
		file_put_contents("data/$from_id/golds.txt","10");
		}
    
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
سلام عجیجم😁💋

این ربات چیکار میتونه بکنه؟🤔
خب اگه تعداد بازدید پست های کانالت کمه😶
اگه میخوای یچیزی باشه که ویو کانالتو ببره بالا!😛
پس به آرزوت رسیدی😂❤️

از الان به بعد شما هر پستی که میزاری کانالت رو مستقیم فروارد کن به من.. منم تعداد بازدید هاشو تو یک چشم به هم زدن افزایش میدم!!!🤥
میگی امکان نعره؟😐
خا امتحانش مجانیه😋
CreaTor🍭 : @mahdiphp
Ch📡: @TmAlpha",
        'parse_mode'=>'html',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"برای سفارش ساخت ویو پنل به ایدی مدیر مراجعه کنید
@Mrbertbot",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
 
	}
	
	elseif($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
	SendMessage($chat_id,"🌹کاربرگرامی،
برای حمایت از ما و بازشدن قفل ربات لطفا در کانال ما عضو شوید👇

🆔 : @GoLd_developer 🔑
🆔 : @TmAlpha 🔑
🆔 : @Cyberphp 🔑

","html","true");
	}
  
  
	elseif($text == "👽دریافت لینک افزایش الماس💎"){

	   $caption = "😶 خسته شدی از بس تو این ربات های بازدیدگیر سکه جمع کردی؟
😃 میخوای یچیزی باشه که به صورت کاملا رایگان ویو پست های کانالت رو افزایش بده؟

🤗 بلاخره انتظارها به پایان رسید! برای اولین بار درکل تلگرام
😍 ربات ویو پنل 👇🏻

🤖: http://telegram.me/?start=$chat_id √";
       bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>new CURLFile('mem.jpg'),
 'caption'=>$caption
 ]);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "کاربر عزیز، شما این بنر بالایی رو به دوستان ، کانال ، گروه های خود ارسال کنید ..

🔺هر یک کاربری که رو لینک شما بزند و وارد ربات شده و استارت را بزند شما 3 عدد الماس دریافت میکنید 🙂",
'reply_to_message_id'=>$bot
        ]);
		
	}
	elseif($text == "🍳سفارش ویو🍳"){
	
	if($tedad > 0){
file_put_contents("data/$from_id/com.txt","set");
	
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"😋 لطفا پست موردنظر خود را برای افزایش ویو آن از کانال خود به من فروارد کنید :",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"←"]],
	]
	])
	]);
		}else{
		
  bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"‼️تعداد الماس های شما کافی نیست، لطفا به بخش حساب کاربری مراجعه کرده و اقدام به افزایش الماس های خود کنید.",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🍳سفارش ویو🍳"],
	['text'=>"🎄حساب کاربری🎄"]],
	[['text'=>"🍟ویو اتوماتیک🍟"],
	['text'=>"👻راهنمای ربات👻"]],
	[['text'=>"🍀آمار ربات🍀"],
              ['text'=>"🎈کانال ما🎈"]],
              [['text'=>"👦پشتیبانی آنلاین👦"],
              ['text'=>"⛔قوانین ربات⛔"]],
              [['text'=>"🚨آپدیت ربات🚨"]],
[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]],
	]
	])
	]);
	}
	}
	
if ($oghab == "set" && $update->message->forward_from_chat->type == "channel") {
    file_put_contents("spam/$from_id.txt",file_get_contents("spam/$from_id.txt") + 1);
    if(file_get_contents("spam/$from_id.txt") <= 1){
	    file_put_contents("data/$from_id/com.txt", "none");
		$newgold = $tedad - 1;
		file_put_contents("data/$from_id/golds.txt", $newgold);
sleep(2);
bot('ForwardMessage', [
'chat_id' => "-1001168614586",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001446037365",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001446037365",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001446037365",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
sleep(1);
bot('ForwardMessage', [
'chat_id' => "-1001446037365",
'from_chat_id' => $chat_id,
'message_id' => $message_id
]);
		bot('sendmessage', ['chat_id' => $chat_id, 'text' => "✅ به پستی که فروارد کردی 150 تا ویو اضافه شد 
💡توجه: برای هر پست یک بار میشه ویو زد پس اگه دوباره بفرستی فرقی به تعداد ویو هاش نمیکنه😐💔", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => 	[[['text'=>"🍳سفارش ویو🍳"],['text'=>"🎄حساب کاربری🎄"]],[['text'=>"🍟ویو اتوماتیک🍟"],['text'=>"👻راهنمای ربات👻"]],[['text'=>"🍀آمار ربات🍀"],['text'=>"🎈کانال ما🎈"]],[['text'=>"👦پشتیبانی آنلاین👦"],['text'=>"⛔قوانین ربات⛔"]],[['text'=>"🚨آپدیت ربات🚨"]],[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]]]]) ]);
        $sofs = $sof + 1;
		file_put_contents("data/sofs.txt", $sofs);
		file_put_contents("spam/$from_id.txt",0);
}
}
if ($oghab == "set" && $update->message->forward_from_chat->type != "channel") {
		file_put_contents("data/$from_id/com.txt", "none");
		bot('sendmessage', ['chat_id' => $chat_id, 'text' => "⚠️ لطفا پُست خود را از یک کانال فروارد کنید !", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => 	[[['text'=>"🍳سفارش ویو🍳"],['text'=>"🎄حساب کاربری🎄"]],[['text'=>"🍟ویو اتوماتیک🍟"],['text'=>"👻راهنمای ربات👻"]],[['text'=>"🍀آمار ربات🍀"],['text'=>"🎈کانال ما🎈"]],[['text'=>"👦پشتیبانی آنلاین👦"],['text'=>"⛔قوانین ربات⛔"]],[['text'=>"🚨آپدیت ربات🚨"]],[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]]]]) ]);
		bot('sendmessage', ['chat_id' => $chat_id, 'text' => "🔻 به منوی اصلی بازگشتیم", 'parse_mode' => 'MarkDown', 'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => 	[[['text'=>"🍳سفارش ویو🍳"],['text'=>"🎄حساب کاربری🎄"]],[['text'=>"🍟ویو اتوماتیک🍟"],['text'=>"👻راهنمای ربات👻"]],[['text'=>"🍀آمار ربات🍀"],['text'=>"🎈کانال ما🎈"]],[['text'=>"👦پشتیبانی آنلاین👦"],['text'=>"⛔قوانین ربات⛔"]],[['text'=>"🚨آپدیت ربات🚨"]],[['text'=>"🌪ربات ویوپنل ساز ما🌪"],['text'=>"☄خرید ربات ویوپنل☄"]]]]) ]);
                 }

if($text == "👻راهنمای ربات👻"){
	SendMessage($chat_id,"⁉️ این ربات کارش چیه؟ و به چه دردی میخوره؟
▪️این ربات واسه افرادی که کانال دارند و بازدید پست های کانالشان کم است و میخواهند یه چیزی باشه که با اون پست های کانالشون رو رایگان سین بزنن! به دردشون میخوره..
همچنین افرادی که در چالش یا مسابقه ویو زدن بنر خود شرکت کردند میتوانند با این ربات ویو آن را به مقدار محدودی افزایش بدهند..

❓چجوری با ویوپنل کار کنم؟
🔸خب خیلی راحته! اول روی دکمه سفارش ویو کلیک کنید..
بعد هم پُست موردنظر خود را از کانال خود یا دیگران به این ربات فروارد کنید..
تمام! 😇

💎 حالا الماس به چه دردی میخوره؟
🔹خب با الماس هاتون میتونید سفارش ویو بدید دیگه وگرنه اگه تموم بشن باید دوباره الماس بگیرید.. چجوری؟ دوتا راه داره یکیش اینکه میتونید زیرمجموعه گیری کنید یکی هم میتونید الماس خریداری کنید..

🔴 اتو ویو چیست؟
♦️خب اگر بازم خسته میشید و اگر پست های کانالتان زیاد میباشد و نمیتوانید به آنها یکی یکی سفارش ویو دهید.. ما چاره ای نیز برای این مشکل یافتیم😃
خب اتو ویو در اینجا به کمک شما میاد.. چجوری کار میکنه؟ خیلی راحت باید اول این بخش رو از ادمین خریداری کنید و بعد ربات ویوپنل رو در کانال خودتون ادمین کنید.. بعد از اون هر پستی که توی کانالتون بزارید یا بقیه بزارن..! تو یک ثانیه به صورت کاملا خودکار ویو پستتون افزایش پیدا میکنه😆
چقدر ویو به پست هایی که تو کانالتون گذاشته میشه اضافه میکنیم؟
خب به تعداد همون قدری که تو بخش سفارش ویو به پست هاتون ویو اضافه میشه در اینجا هم همونقدر..😍
😇 خب قیمت فعالسازی این بخش چنده؟
ببینید شما فکر کنید یه ادمین انسان خصوصی بگیرید که واستون هر پستی که از کانالتون دریافت کرد رو تو یک ثانیه تعداد ویوهاشو به مقدادlر قابل توجی افزایش بده!
طبیعتا پول زیادی ازتون میگیره یا اصلا همچین کسی برای این کار آماده نمیشه😐
خب ولی ویوپنل حاظره که با هزینه خیلی کم یعنی فقط 30 تومن برای همیشه این کار رو واستون انجام بده😍😆

","html","true");
	}
/*
☆《Alpha Team》☆
▪مرجع بهترین و جدیدترین سورس های ربات
▪مرجع تیکه کد های کاربردی
▪مرجع قالب و افزونه سایت
° Telegram.me/TmAlpha
° @TmAlpha
*/
	elseif($text == "🎈کانال ما🎈"){
	SendMessage($chat_id,"برای حمایت از ما وارد کانال ما شید🙏👇
@TmAlpha","html","true");
	}

elseif($text == "🌪ربات ویوپنل ساز ما🌪"){
	SendMessage($chat_id,"ربات ویوپنل ساز ما میتوانید ویوپنل خود را بدون هیچ هزنیه ای بسازید🙏👇
@Mrbertbot","html","true");
	}

elseif($text == "☄خرید ربات ویوپنل☄"){
	SendMessage($chat_id,"👩‍💻جهت ارتباط با مدیربات ویوپنل به آیدی زیر مراجعه کنید👨‍💻
شما میتوانید ویوپنل مارا اجاره یا یک ویوپنل برای خودتان بخرید
👨‍💻 : @mahdiphp
🤖 : @Mrbertbot","html","true");
	}

	elseif($text == "👦پشتیبانی آنلاین👦"){
	SendMessage($chat_id,"👩‍💻جهت ارتباط با مدیریت ربات ویوپنل به آیدی زیر مراجعه کنید👨‍💻

👨‍💻 : @mahdiphp
🤖 : @Mrbertbot","html","true");
	}

	elseif($text == "⛔قوانین ربات⛔"){
	SendMessage($chat_id,"🍃 قوانین ویو پنل 🍃
➖➖➖➖➖➖➖➖
✔️ تمامی مطلب ها باید تابع قوانین جمهوری اسلامی ایران باشد.

✔️ سین زدن به هرگونه کانال +18 که خلاف قوانین ربات میباشد و در صورت مشاهده شما از ربات بلاک میشوید و همچنین دیگر نمیتوانید سین بزنید.

✔️ در صورت مشاهده استفاده از قابلیت های ربات در چیز های منفی به شدت برخورد میشود.

✔️ اگر به هر دلیلی درخواست های سین زدن به سرور ما بیش از حد معمول باشد (و اشتراک ربات ویژه نباشد) چند باری به شما اخطار داده میشود، اگر این اخطار ها نادیده گرفته شوند شما از ربات مسدود میشوید و به هیچ عنوان از محدودیت خارج نمیشوید.
➖➖➖➖➖➖➖➖","html","true");
	}
	elseif($text == "🚨آپدیت ربات🚨"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"‌⚗️ربات ویو پنل با موفقیت آپدیت شد و تمام اطلاعات شما بروز شد⚗️",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"←"]]
	]
	])
	]);
	}

	if($text == "🍟ویو اتوماتیک🍟"){
		SendMessage($chat_id,"
		🔴 اتو ویو چیست؟
♦️خب اگر بازم خسته میشید و اگر پست های کانالتان زیاد میباشد و نمیتوانید به آنها یکی یکی سفارش ویو دهید.. ما چاره ای نیز برای این مشکل یافتیم😃
خب اتو ویو در اینجا به کمک شما میاد.. چجوری کار میکنه؟ خیلی راحت باید اول این بخش رو از ادمین خریداری کنید و بعد ربات ویوپنل رو در کانال خودتون ادمین کنید.. بعد از اون هر پستی که توی کانالتون بزارید یا بقیه بزارن..! تو یک ثانیه به صورت کاملا خودکار ویو پستتون افزایش پیدا میکنه😆
چقدر ویو به پست هایی که تو کانالتون گذاشته میشه اضافه میکنیم؟
خب به تعداد همون قدری که تو بخش سفارش ویو به پست هاتون ویو اضافه میشه در اینجا هم همونقدر..😍
😇 خب قیمت فعالسازی این بخش چنده؟
ببینید شما فکر کنید یه ادمین انسان خصوصی بگیرید که واستون هر پستی که از کانالتون دریافت کرد رو تو یک ثانیه تعداد ویوهاشو به مقدادlر قابل توجی افزایش بده!
طبیعتا پول زیادی ازتون میگیره یا اصلا همچین کسی برای این کار آماده نمیشه😐
خب ولی ویوپنل حاظره که با هزینه خیلی کم یعنی فقط 30 تومن برای همیشه این کار رو واستون انجام بده😍😆

☂️ کاربرعزیز برای خرید بخش اتو ویو لطفا به پشتیبانی پیام دهید 👇🏻

👨🏻‍💻: @mahdiphp

♨️ هزینه فعال کردن این بخش فقط 30 تومن هست.","html","true");
	}
	
	
	elseif($text == "🎄حساب کاربری🎄"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"👤در اینجا میتوانید حساب کاربری خود را مدیریت کنید ..

⚠️توجه: با هر یک عدد الماس، میتوانید یک تبلیغ ثبت کنید

💍 الماس های خود را با خرید یا زیرمجموعه گیری افزایش دهید یا از تعداد باقی مانده اطلاع یابید 👇‌",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🌈 الماس های من"]],
	[['text'=>"💳 خرید الماس"]],
	[['text'=>"👽دریافت لینک افزایش الماس💎"]],
	[['text'=>"←"]]
	]
	])
	]);
	}
	
	elseif($text == "🌈 الماس های من"){
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"😊 نام شما : $first
  
😁 تعداد الماس های شما : $tedad

برای کسب الماس های بیشتر روی دکمه (دریافت لینک افزایش الماس) بزنید😀",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"🌈 الماس های من"]],
	[['text'=>"💳 خرید الماس"]],
	[['text'=>"👽دریافت لینک افزایش الماس💎"]],
	[['text'=>"←"]]
	]
	])
	]);
	}
	
	elseif($text == "💳 خرید الماس"){
	SendMessage($chat_id,"💡تعرفه خرید الماس در ربات ویوپنل :

📣 تعداد هر `50` عدد الماس، فقط `1,000` تومان .
∞
🎗بسته های تخفیف دار :

💎 تعداد `250` عدد الماس، فقط `4,000` تومان .
💎 تعداد `1000` عدد الماس، فقط `19,000` تومان .

°°°°°°°°°°°°°°°
🌹کاربرگرامی، جهت خرید الماس با پشتیبانی در ارتباط باشید🔻

👨🏻‍💻: @mahdiphp","html","true");
	}

#--- PANEL ADMIN ---

elseif($text == "مدیریت" && $chat_id == $ADMIN){

file_put_contents("data/$from_id/com.txt","none");

        bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"ادمین عزیز به پنل مدیریتی ربات خوش آمدید😊",
               'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	  [['text'=>"💸افزایش الماس کاربر"],
	['text'=>"🍀آمار ربات🍀"]],
		[['text'=>"▫️پیام همگانی"],
			['text'=>"▪️فروارد همگانی"]],
			[['text'=>"🎁 الماس همگانی"]],
			[['text'=>"💤خاموش کردن"],
	['text'=>"❇️روشن کردن"]],
	]
	])
	]);
	}

		elseif($text == "🎁 الماس همگانی" && $from_id == $ADMIN){
file_put_contents("data/$from_id/com.txt","coin to all");
SendMessage($chat_id,"🔢 لطفا تعداد الماس را بصورت عدد وارد کنید :",'HTML',$back_admin,$message_id);
}

elseif($text == "💤خاموش کردن" && $from_id == $ADMIN){
file_put_contents("on.txt","off");
SendMessage($chat_id,"🎭 ربات خاموش شد",'HTML',$back_admin,$message_id);
}

elseif($text == "❇️روشن کردن" && $from_id == $ADMIN){
file_put_contents("on.txt","on");
SendMessage($chat_id,"🙃 ربات روشن شد",'HTML',$back_admin,$message_id);
}

elseif($oghab == "coin to all"){
if(preg_match('/^([0-9])/',$text)){
file_put_contents("data/$from_id/wait.txt",$text);
file_put_contents("data/$from_id/com.txt","coin to all 2");
SendMessage($chat_id,"⁉️ آیا ارسال $text الماس به تمام کاربران ربات را تایید میکنید ؟

بله یا خیر؟",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"برگشت به منوی مدیریت"]],[['text'=>"خیر"],['text'=>"بله"]]]]),$message_id);
}else{
SendMessage($chat_id,"⚠️ ورودی نامعتبر است !
👈🏻 لطفا فقط عدد ارسال کنید :",'HTML',$back_admin,$message_id);
}}
elseif($oghab == "coin to all 2"){
if($text == "خیر"){
unlink("data/$from_id/wait.txt");
file_put_contents("data/$from_id/com.txt",'none');
SendMessage($chat_id,"✅ با موفقیت لغو شد !",'html',$admin_keyboard,$message_id);
}
elseif($text == "بله"){
$Member = explode("\n",$list);
$count = count($Member)-2;
file_put_contents("data/$from_id/com.txt",'none');
for($z = 0;$z <= $count;$z++){
$user = $Member[$z];
if($user != "\n" && $user != " "){
$coin = file_get_contents("data/$user/golds.txt");
file_put_contents("data/$user/golds.txt",$coin + $wait);
SendMessage($user,"🎊 تبریک !!
🎁 از طرف ادمین مقدار $wait الماس هدیه به شما تعلق گرفت ...", "html","true");
}}
unlink("data/$from_id/wait.txt");
SendMessage($chat_id,"✅ با موفقیت به تمام اعضا مقدار $wait الماس ارسال شد !",'html',"true",$admin_keyboard,$message_id);
}else{
SendMessage($chat_id,"💢 لطفا فقط از کیبورد زیر انتخاب کنید :",'HTML',json_encode(['resize_keyboard'=>true,'keyboard'=>[[['text'=>"برگشت به منوی مدیریت"]],[['text'=>"خیر"],['text'=>"بله"]]]]),$message_id);    
}}


		elseif($text == "💸افزایش الماس کاربر" && $chat_id == $ADMIN){
			file_put_contents("data/$from_id/com.txt","sendauto");
  bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"ایدی عددی کاربر مورد نظر را ارسال کنید :",'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"←"]],
	[['text'=>""]]
	]
	])
	]);
	}

	elseif($oghab == "sendauto" && $chat_id == $ADMIN){
	
	$teee = file_get_contents('data/'.$text."/golds.txt");
file_put_contents('data/'.$text."/golds.txt",$teee+10);

bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"تعداد 10 الماس به کاربر مورد نظر ارسال شد ✅",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>"💸افزایش الماس کاربر"],
	['text'=>"🍀آمار ربات🍀"]],
		[['text'=>"▫️پیام همگانی"],
			['text'=>"▪️فروارد همگانی"]],
			[['text'=>"🎁 الماس همگانی"]],
				[['text'=>"💤خاموش کردن"],
	['text'=>"❇️روشن کردن"]],
      ],'resize_keyboard'=>true])
  ]);
  
  file_put_contents("data/$from_id/com.txt","none");
  
	}

elseif($text == "🍀آمار ربات🍀"){
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
	sendmessage($chat_id , "📊 آمار ربات ویوپنل

▫️تعداد کاربران: $member_count
▫️تعداد سفارشات: $sof
▫️پینگ سرور: $load[0]", "html","true");
}
elseif($text == "▫️پیام همگانی" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","send");
	
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" پیام مورد نظر رو در قالب متن بفرستید:",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'مدیریت']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($oghab == "send" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","no");
    
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ پیام همگانی فرستاده شد.",
  ]);
		$all_member = fopen( "Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($sticker_id != null){
			SendSticker($user,$sticker_id);
			}
			elseif($video_id != null){
			SendVideo($user,$video_id,$caption);
			}
			elseif($voice_id != null){
			SendVoice($user,$voice_id,'',$caption);
			}
			elseif($file_id != null){
			SendDocument($user,$file_id,'',$caption);
			}
			elseif($music_id != null){
			SendAudio($user,$music_id,'',$caption);
			}
			elseif($photo2_id != null){
			SendPhoto($user,$photo2_id,'',$caption);
			}
			elseif($photo1_id != null){
			SendPhoto($user,$photo1_id,'',$caption);
			}
			elseif($photo0_id != null){
			SendPhoto($user,$photo0_id,'',$caption);
			}
			elseif($text != null){
			SendMessage($user,$text,"html","true");
			}
		}
}
elseif($text == "▪️فروارد همگانی" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","fwd");
	
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"پیام خودتون را فروراد کنید:",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'مدیریت']],
      ],'resize_keyboard'=>true])
  ]);
}

elseif($oghab == "fwd" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/com.txt","no");
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"درحال فروارد",
  ]);
$forp = fopen( "Member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
   bot('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"با موفقیت فروارد شد.", 
   ]);
}
}
/*
☆《Alpha Team》☆
▪مرجع بهترین و جدیدترین سورس های ربات
▪مرجع تیکه کد های کاربردی
▪مرجع قالب و افزونه سایت
° Telegram.me/TmAlpha
° @TmAlpha
*/
?>
