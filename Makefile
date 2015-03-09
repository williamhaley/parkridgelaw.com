deploy:
	rsync -avz --delete --exclude='.git' -e ssh ./ willhale@willhaley.com:~/public_html/williamHaleyLaw/test/

