var current = null;
document.querySelector('#full_name').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: 0,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '200 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});
document.querySelector('#user_name').addEventListener('focus', function(e) {
	if (current) current.pause();
	current = anime({
	  targets: 'path',
	  strokeDashoffset: {
		value: -336,
		duration: 700,
		easing: 'easeOutQuart'
	  },
	  strokeDasharray: {
		value: '200 1386',
		duration: 700,
		easing: 'easeOutQuart'
	  }
	});
});
document.querySelector('#password').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: -730,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '200 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});
document.querySelector('#submit').addEventListener('focus', function(e) {
  if (current) current.pause();
  current = anime({
    targets: 'path',
    strokeDashoffset: {
      value: -1000,
      duration: 700,
      easing: 'easeOutQuart'
    },
    strokeDasharray: {
      value: '530 1386',
      duration: 700,
      easing: 'easeOutQuart'
    }
  });
});