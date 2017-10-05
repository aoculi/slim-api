.PHONY: endpoint-users

endpoint-users:
	mkdir -p plugins
	curl -Lk -o plugins/package.zip https://github.com/aoculi/slim-api-users/archive/master.zip
	unzip plugins/package.zip -d plugins
	cp -r plugins/slim-api-users-master/src/Api/Endpoints/* src/Api/Endpoints
	cp -r plugins/slim-api-users-master/tests/app/Endpoints/* tests/app/Endpoints
	rm -R plugins