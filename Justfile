default:
    @just -l

prod:
	npm run prod

dev:
	npm run dev

deploy commit_msg: prod
	#!/usr/bin/env sh
	git add -A
	git commit -m "{{commit_msg}}"
	git push origin master