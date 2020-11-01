<?php

require_once('../dbconnect.php');

/* PHPDocとは？
コメントを書く時の共通の形式。
（例）クラスやメソッドの役割を書く時は・・・
*/

class UserLogic
{
  /**
   * ユーザーを登録する
   * @param array $userData //←こういう文字で変数を指定しているのだから・・・
   * @return bool $result
   */
  public static function createUser($userData)
  {
    $result = false; //←最初にこちらを設定しておく
    $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

    // ユーザーデータを配列に入れる
    $arr = [];
    /** 変数のスペルにはくれぐれも注意することだ。
     *  私なんか「$UserData」と記述してたが為にエラーになっていた事に気付かずに
     *  その日の「金曜ロードショー」を見逃した位なのだ。 */
    $arr[] = $userData['username'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);
    /* これでパスワードをハッシュ化している */
    try { //これが「例外処理」。
      $stmt = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result; //←うまく言った場合は$resultがtrueになる
    }catch(\Exception $e){
      return $result; //そうでなければfalseのまま
    }
    
  }
  /**
   * ログイン処理をする
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password)
  {
    // 処理結果
    $result = false;
    // ユーザーをemailから検索して取得
    $user = self::getUserByEmail($email);

    if (!$user){
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    //パスワードの照会
    if(password_verify($password, $user['password'])){
      //ログイン成功
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }

    $_SESSION['msg'] = 'パスワードが一致しません。';
    return $result;
  }

  /**
   * emailからユーザーを取得する
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getUserByEmail($email)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す
    $sql = 'SELECT * FROM users WHERE email=?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    /* これでパスワードをハッシュ化している */
    try { //これが「例外処理」。
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      // SQLの結果が返される
      $user = $stmt->fetch();
      return $user; //←うまく言った場合は$resultがtrueになる
    }catch(\Exception $e){
      return false; //そうでなければfalseのまま
    }
  }
  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
      $result = false;
      
      //セッションにログインユーザーが入っていなければfalseにする
      if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0){
          return $result = true;
      }
      
      return $result;
  }
  
  /**
   * ログアウト処理
   */
   public static function logout(){
       $_SESSION = array();
       session_destroy();
   }
  
}