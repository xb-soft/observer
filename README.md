### observer 
observer of xbsoft

 - install
```
composer require xbsoft/observer
```

 - example
```

	<?php
	use xb\observer\Subject as ObSubject;
	$subject = new ObSubject;
	$mail = __NAMESPACE__ . '\\observer\\Mail';
	$push = __NAMESPACE__ . '\\observer\\Push';
	$sms = __NAMESPACE__ . '\\observer\\Sms';
	
	$subject->bind('mail', function () {
		return [
			'rec' => 'xxx@gmail.com',
			'title' => 'test mail',
		];
	});
	$subject->bind('push', function () {
		return [
			'lawer' => new \StdClass,
			'leader' => new \StdClass,
		];
	});

	$subject->bind('sms', function () {
		return [
			'phone' => 'xxxxxxxx',
			'content' => 'test sms',
		];
	});

	$subject->bind('common', function () {
		return new \ArrayObject;
	});
	
	$subject->attach(new $mail);
	$subject->attach(new $push);
	$subject->attach(new $sms);

	$subject->notify();
	?>
```

```

	<?php
	use xb\observer\Server as ObServer;

	class MailObserver extends ObServer {
	
		public function doTask($subject) {
			echo '<pre>';
			print_r($subject->mail);
			echo '</pre>';
			echo '<pre>';
			print_r($subject->common);
			echo '</pre>';
		}
	}
	?>
```
