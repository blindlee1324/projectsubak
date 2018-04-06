
# 프로젝트 수박

이 소스코드는 다음 버전을 기준으로 한다.

컴포넌트|버전
---|---
프레임워크(`laravel/laravel`)|5.3.0
핵심 컴포넌트(`laravel/framework`)|5.3.9

## 다운로드

`myapp`은 소스코드를 복제할 디렉터리 이름이다.

```sh
~ $ git clone https://github.com/blindlee1324/projectsubak.git myapp
```


### 프로젝트의 의존성 설치

내려 받은 소스코드는 이 프로젝트가 의존하는 컴포넌트들을 포함하지 않고 있다. [컴포저(composer)](https://getcomposer.org/)로 이 프로젝트가 의존하는 컴포넌트를 설치한다.

소스코드를 복제한 `myapp` 디렉터리로 이동한다.

```sh
~ $ cd myapp
```

(선택 사항) 태그로 이동했을 때를 대비해서, 마스터 브랜치로 이동한다.

```sh
~/myapp $ git checkout master
```

이 프로젝트가 의존하는 컴포넌트를 설치한다.

```sh
~/myapp $ composer install
```

### 환경 설정

`.env.example` 파일을 복사하여 `.env` 파일을 만든다. 파일을 열어 자신의 환경에 맞게 적절히 수정하고 저장한다. 예를 들어 사용할 데이터베이스가 `myapp`라면 `DB_DATABASE=myapp`으로 수정한다.

```sh
~ $ cd myapp
~/myapp $ cp .env.example .env
```

암호화 키를 만든다. 아래 명령을 수행함과 동시에 `.env` 파일에 방금 만든 키가 자동으로 등록된다. 

```sh
~/myapp $ php artisan key:generate
```

Mac 또는 Linux를 사용한다면, `storage`, `bootstrap/cache`, `public\files` 디렉터리의 권한을 변경한다.

```sh
~/myapp $ chmod -R 777 storage bootstrap/cache public/files
```

### 데이터베이스 마이그레이션 및 시딩

아래 명령을 실행하기 전에 `.env` 파일에서 선언한 데이터베이스가 있고, 데이터베이스에 로그인할 사용자가 권한이 있는 지 확인한다. 잘 모르겠다면 7장까지 읽고 다시 이 문서로 돌아오기 바란다.

이 명령은 테이블을 만들고 더미 데이터를 심는 과정이다.

```sh
~/myapp $ php artisan migrate --seed --force
```

## 소스코드 구동 확인

PHP 내장 웹 서버와 로컬 데이터베이스를 사용한다고 가정한다.

### 브라우저

PHP 내장 웹 서버를 구동한다.

```sh
~/myapp $ php artisan serve
# Laravel development server started on http://localhost:8000/
```

이제 웹 브라우저에서 `http://localhost:8000`으로 접속해서 실습 예제의 동작을 확인한다.

## 시나리오

### 삽입
![Alt Text](https://github.com/blindlee1324/projectsubak/blob/master/instruction/insertion.gif)

## 라이선스

이 소스코드는 [MIT](https://github.com/appkr/l5code/blob/master/LICENSE) 라이선스를 따른다.
