<?php
/**
 * Script para simular la base de datos de la Red Social para el proyecto del primer trimestre
 */
session_start();
$red;
if(isset($_SESSION['red'])) {
	$red = $_SESSION['red'];
}
else {
	$red = new Red();
	$_SESSION['red'] = $red;
}



/**
 * Clase Red: simula una base de datos
 * 
 * Ejemplo: Ya existe la variable <b>$red</b> para usar toda la funcionalidad de esta clase
 *
 * @author Álex Torres
 */
class Red
{
	/**
	 * @ignore
	 * @property array $users array que simula la tabla con todos los usuarios
	 */
	private $users = array();
	/**
	 * @ignore
	 * @property array $revels array que simula la tabla con todas las revels
	 */
	private $revels = array();
	/**
	 * @ignore
	 * @property array $comments array que simula la tabla con todos los comentarios
	 */
	private $comments = array();
	/**
	 * @ignore
	 * @property array $followers array que simula la tabla de los usuarios a quienes se sigue
	 */
	private $followers = array();
	
	/**
	 * Constructor de la clase Red
	 *
	 * @ignore
	 * @return Red[] Crea un objeto que simula la conexión a la base de datos
	 */
	function __construct()
	{
		// Users
		array_push($this->users, new User(1, 'Antonio', 'Antonio', 'antonio@mail.com'));
		array_push($this->users, new User(2, 'Lucas', 'Lucas', 'lucas@mail.com'));
		array_push($this->users, new User(3, 'Ana', 'Ana', 'ana@mail.com'));
		array_push($this->users, new User(4, 'Patricia', 'Patricia', 'patricia@mail.com'));
		array_push($this->users, new User(5, 'Oscar', 'oscar', 'oscar@mail.com'));
		array_push($this->users, new User(6, 'Eva', 'Eva', 'eva@mail.com'));
		
		//Revels
		$formato = 'Y-m-d H:i:s';		
		array_push($this->revels, new Revel(1, 1, 'De vacaciones', DateTime::createFromFormat($formato, '2018-08-6 15:16:17')));
		array_push($this->revels, new Revel(2, 1, 'En la playa (Tenerife)', DateTime::createFromFormat($formato, '2018-08-30 18:10:17')));
		array_push($this->revels, new Revel(3, 4, 'Probando esto', DateTime::createFromFormat($formato, '2018-08-20 11:45:17')));
		array_push($this->revels, new Revel(4, 5, 'Me han contratado en una empresa nueva', DateTime::createFromFormat($formato, '2018-09-22 9:06:17')));
		array_push($this->revels, new Revel(5, 3, 'Disfrutando de la vida', DateTime::createFromFormat($formato, '2018-09-19 22:55:17')));
		array_push($this->revels, new Revel(6, 1, 'Submarinismo en Fuerteventura', DateTime::createFromFormat($formato, '2018-09-2 17:15:17')));
		array_push($this->revels, new Revel(7, 4, 'A tope con la vida', DateTime::createFromFormat($formato, '2019-01-11 23:16:17')));
		array_push($this->revels, new Revel(8, 2, 'Hola hola', DateTime::createFromFormat($formato, '2019-02-20 10:11:17')));
		array_push($this->revels, new Revel(9, 2, 'Aquí estoy', DateTime::createFromFormat($formato, '2019-02-8 13:21:17')));
		array_push($this->revels, new Revel(10, 1, 'Ya de vuelta en casa', DateTime::createFromFormat($formato, '2019-03-5 14:01:17')));
		array_push($this->revels, new Revel(11, 5, 'Me encanta esta empresa', DateTime::createFromFormat($formato, '2019-03-15 12:28:17')));
		
		//Comment
		array_push($this->comments, new Comment(1, 2, 6, 'Qué bien te lo montas'));
		array_push($this->comments, new Comment(2, 3, 6, 'Seguro que te gusta'));
		array_push($this->comments, new Comment(3, 3, 1, 'Vamossss'));
		
		//Followers
		array_push($this->followers, new Follow(6, 1));
		array_push($this->followers, new Follow(6, 4));
		array_push($this->followers, new Follow(1, 4));
	}
	
	/**
	 * Devuelve los datos de un usuario dada su id
	 *
 	 * Ejemplo: <b>$user = $red->selectUserById(1);</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[]|null Devuelve un array con los datos del user o null si no existe
	 */
	public function selectUserById($id)
	{
		$user = null;
		foreach($this->users as $user)
			if($user->id == $id)
				return $user->toArray();
	}

	/**
	 * Devuelve los datos de un usuario dado su nombre de usuario
	 *
 	 * Ejemplo: <b>$user = $red->selectUserByUserName('Rick');</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[]|null Devuelve un array con los datos del user o null si no existe
	 */
	public function selectUserByUserName($userName)
	{
		$user = null;
		foreach($this->users as $user)
			if($user->name == $userName)
				return $user->toArray();
	}

	/**
	 * Devuelve los datos de un usuario dado su email
	 *
 	 * Ejemplo: <b>$user = $red->selectUserByEmail('rick@mail.com');</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[]|null Devuelve un array con los datos del user o null si no existe
	 */
	public function selectUserByEmail($mail)
	{
		$user = null;
		foreach($this->users as $user)
			if($user->mail == $mail)
				return $user->toArray();
	}
	
	/**
	 * Devuelve las revel de un usuario
	 *
 	 * Ejemplo: <b>$revels = $red->selectRevelsFromUser(1);</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[] Devuelve array multidimensional con todos los revel del usuario
	 */
	public function selectRevelsFromUser($id)
	{	
		if($this->selectUserById($id)==null)
			return array();
		
		$revels = array();
		foreach($this->revels as $revel)
			if($revel->userId == $id)
				 array_push($revels, $revel->toArray());
		return $revels;
	}
	
	/**
	 * Devuelve los usuarios a los que sigue el usuario
	 *
 	 * Ejemplo: <b>$follows = $red->selectFollowsFromUser(1);</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[] Devuelve array multidimensional con todos los usuarios a los que sigue
	 */
	public function selectFollowsFromUser($id)
	{
		if($this->selectUserById($id)==null)
			return array();
		
		$follows = array();
		foreach($this->followers as $follow)
			if($follow->userId == $id)
				$follows[] = $this->selectUserById($follow->followedId);
		return $follows;
	}
	
	/**
	 * Devuelve los datos de una revel
	 *
 	 * Ejemplo: <b>$revel = $red->selectRevel(1);</b>
	 *
	 * @param int $id identificador de revel 
	 * @return array[]|null Devuelve un array con los datos del revel o null si no existe
	 */
	public function selectRevel($id)
	{
		$revel = null;
		foreach($this->revels as $revel)
			if($revel->id == $id)
				return $revel->toArray();
	}
	
	/**
	 * Devuelve los datos de un comentario
	 *
 	 * Ejemplo: <b>comment = $red->selectComment(1);</b>
	 *
	 * @param int $id identificador de comentario 
	 * @return array[]|null Devuelve un array con los datos del comentario o null si no existe
	 */
	public function selectComment($id)
	{
		$comment = null;
		foreach($this->comments as $comment)
			if($comment->id == $id)
				return $comment->toArray();
	}
	
	/**
	 * Devuelve los comentarios de una revel
	 *
 	 * Ejemplo: <b>$comments = $red->selectCommentsFromRevel(1);</b>
	 *
	 * @param int $id identificador de revel 
	 * @return array[] Devuelve array multidimensional con todos los comentarios de una revel
	 */
	public function selectCommentsFromRevel($id)
	{
		if($this->selectRevel($id)==null)
			return array();
		
		$comments = array();
		foreach($this->comments as $comment)
			if($comment->revelId == $id)
				$comments[] = $comment->toArray();
		return $comments;
	}
	
	/**
	 * Devuelve las revel del tablón del usuario
	 *
 	 * Ejemplo: <b>$revelsForNoticeBoard = $red->selectRevelsForUser(1);</b>
	 *
	 * @param int $id identificador de usuario 
	 * @return array[] Devuelve array multidimensional con todas las revel del tablón del usuario
	 */
	public function selectRevelsForUser($id)
	{
		if($this->selectUserById($id)==null)
			return array();
		
		$follows = $this->selectFollowsFromUser($id);
		
		//array con los id del usuario y a los que sigue
		$usersId = array();
		$usersId[] = $id;	//se almacena el id del usuario
		foreach($follows as $follow)
			$usersId[] = $follow['id'];	//se almacenan los id de los que sigue
		
		$revels = array();
		foreach($this->revels as $revel)
			if(in_array($revel->userId, $usersId))
				$revels[] = $revel->toArray();
		
		return $revels;
	}
	
	
	/**
	 * Guarda los datos de un usuario
	 *
 	 * Ejemplo: <b>$newUser = $red->insertUser('Juan', 'contraseña', 'juan@mail.com');</b>
	 *
	 * @param string $name nombre de usuario
	 * @param string $pass contraseña de usuario
	 * @param string $mail mail de usuario
	 * @return int Devuelve el identificador del nuevo usuario
	 */
	public function insertUser($name, $pass, $mail)
	{
		$userId = 0;
		$userId = $this->users;
		$userId = end($userId)->id;
		$userId++;
		
		array_push($this->users, new User($userId, $name, $pass, $mail));
		
		$this->saveChangesInSession();
			
		return $userId;
	}
	
	/**
	 * Actualiza los datos de un usuario
	 *
 	 * Ejemplo: <b>if($red->updateUser(1, 'Juan', 'contraseña', 'juan@mail.com')) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'OK';</b>
	 *
	 * @param int $id id de usuario
	 * @param string $name nombre de usuario
	 * @param string $pass contraseña de usuario
	 * @param string $mail mail de usuario
	 * @return boolean Devuelve true si se realiza correctamente
	 */
	public function updateUser($id, $name, $pass, $mail)
	{
		if($this->selectUserById($id)==null)
			return false;
		
		foreach($this->users as $key => $user) {
			if($user->id == $id) {
				$user->name = $name;
				$user->pass = $pass;
				$user->mail = $mail;
				
				$this->saveChangesInSession();
				
				return true;
			}
		}
	}

	/**
	 * Comprueba si la contraseña recibida coincide con la almacenada
	 *
 	 * Ejemplo: <b>if($red->login('juan@mail.com', 'contraseña')) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'login ok';</b>
	 *
	 * @param string $mail mail de usuario
	 * @param string $pass contraseña de usuario
	 * @return boolean Devuelve true si se realiza correctamente
	 */
	public function login($mail, $pass)
	{
		$result = false;
		foreach($this->users as $key => $user) {
			if(strcmp($user->mail, $mail) == 0) {
				$result = password_verify($pass, $user->pass);
			}
		}
		
		return $result;
	}
	
	/**
	 * Guarda los datos de una revel
	 *
 	 * Ejemplo: <b>$newRevel = $red->insertRevel(1, 'texto de la revel');</b>
	 *
	 * @param int $userId id de usuario
	 * @param string $text texto de la revel
	 * @return int Devuelve el identificador de la nueva revel o -1 si error
	 */
	public function insertRevel($userId, $text)
	{
		//comprobar si existe user
		if($this->selectUserById($userId)==null)
			return -1;
		
		$revelId = 0;
		$revelId = $this->revels;
		$revelId = end($revelId)->id;
		$revelId++;
		
		array_push($this->revels, new Revel($revelId, $userId, $text));
		
		$this->saveChangesInSession();
		
		return $revelId;
	}
	
	/**
	 * Guarda los datos de un comentario
	 *
 	 * Ejemplo: <b>$newComment = $red->insertComment(1, 2, 'texto del comentario');</b>
	 *
	 * @param int $revelId id de revel
	 * @param int $userId id de usuario
	 * @param string $text texto del comentario
	 * @return int Devuelve el identificador de la nueva revel o -1 si error
	 */
	public function insertComment($revelId, $userId, $text)
	{
		//comprobar si existe revel
		if($this->selectRevel($revelId)==null)
			return -1;
		//comprobar si existe user
		if($this->selectUserById($userId)==null)
			return -1;
		
		//comprobar si el usuario le sigue
		// se obtienen todos a los que sigue
		$follows = $this->selectFollowsFromUser($userId);
		// array con los id de los que sigue
		$followsUsersId = array();
		foreach($follows as $follow)
			$followsUsersId[] = $follow->id;	//se almacenan los id de los que sigue
		//id del autor de la revel		
		$revelUserId = $this->selectRevel($revelId)->userId;
		if(!in_array($revelUserId, $followsUsersId))
			return -1;
		
		$commentId = 0;
		$commentId = $this->comments;
		$commentId = end($commentId)->id;
		$commentId++;
		
		array_push($this->comments, new Comment($commentId, $revelId, $userId, $text));
		
		$this->saveChangesInSession();
		
		return $commentId;
	}
	
	/**
	 * Guarda un nuevo seguidor
	 *
 	 * Ejemplo: <b>if($red->insertFollow(1, 2)) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'Ahora le sigues';</b>
	 *
	 * @param int $userId id de revel
	 * @param int $followedId id de usuario
	 * @return boolean Devuelve true/false según funcione o no
	 */
	public function insertFollow($userId, $followedId)
	{
		//no se puede seguir a sí mismo
		if($userId == $followedId)
			return false;
		//comprobar si existe user
		if($this->selectUserById($userId)==null)
			return false;
		//comprobar si existe al que se va a seguir
		if($this->selectUserById($followedId)==null)
			return false;
		//comprobar si no le está siguiendo ya
		foreach($this->followers as $follow)
			if($follow->userId == $userId && $follow->followedId == $followedId)
				return false;
		
		array_push($this->followers, new Follow($userId, $followedId));
	}
	
	/**
	 * Devuelve los usuarios cuyo nombre coincida con la búsqueda
	 *
 	 * Ejemplo: <b>$resultSearch = $red->searchUsers('ton');</b>
	 *
	 * @param string $search texto a buscar entre los nombres de los usuarios
	 * @return array[] Devuelve array multidimensional con todos los usuarios que coincidan
	 */
	public function searchUsers($search)
	{
		$usersMatch = array();
		foreach($this->users as $user)
			if(strstr(strtolower($user->name), strtolower($search)) != false)
				$usersMatch[] = $user->toArray();
		
		return $usersMatch;
	}
	
	/**
	 * Borra un comentario
	 *
 	 * Ejemplo: <b>if($red->deleteComment(1)) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'comentario elilminado';</b>
	 *
	 * @param int $id id del comentario
	 * @return boolean Devuelve true/false según funcione o no
	 */
	public function deleteComment($id)
	{
		//comprobar si existe comentario
		if($this->selectComment($id)==null)
			return false;
		
		$result = false;
		foreach($this->comments as $key => $comment)
			if($comment->id == $id) {
				unset($this->comments[$key]);
				$result = true;
			}
		
		$this->saveChangesInSession();
		
		return $result;
	}
	
	/**
	 * Borra una revel y todos sus comentarios
	 *
 	 * Ejemplo: <b>if($red->deleteRevel(1)) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'revel y sus comentarios elilminados';</b>
	 *
	 * @param int $id id de la revel
	 * @return boolean Devuelve true/false según funcione o no
	 */
	public function deleteRevel($id)
	{
		//comprobar si existe revel
		if($this->selectRevel($id)==null)
			return false;
		
		//eliminar primero los comentarios de esa revel
		foreach($this->comments as $comment)
			if($comment->revelId == $id)
				$this->deleteComment($comment->id);
		
		//eliminar la revel
		$result = false;
		foreach($this->revels as $key => $revel)
			if($revel->id == $id) {
				unset($this->revels[$key]);
				$result = true;
			}
		
		$this->saveChangesInSession();
		
		return $result;
	}
	
	/**
	 * Borra un usuario y todas sus revels y los comentarios de estas
	 *
 	 * Ejemplo: <b>if($red->deleteUser(1)) <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo 'Usuario, sus revels y comentarios de estas eliminados';</b>
	 *
	 * @param int $id id del user
	 * @return boolean Devuelve true/false según funcione o no
	 */
	public function deleteUser($id)
	{
		//comprobar si existe usuario
		if($this->selectUserById($id)==null)
			return false;
		
		// se eliminan las revel de ese usuario y por extensión sus comentarios
		foreach($this->revels as $revel)
			if($revel->userId == $id)
				$this->deleteRevel($revel->id);
		
		//eliminar usuario
		$result = false;
		foreach($this->users as $key => $user)
			if($user->id == $id) {
				unset($this->users[$key]);
				$result = true;
			}
		
		$this->saveChangesInSession();
		
		return $result;
	}

/*	public function selectAllUsers()
	{
		return $this->users;
	}
	function selectAllRevels()
	{
		return $this->revels;
	}
	function selectAllComments()
	{
		return $this->comments;
	}*/
	
	/**
	 * @ignore
	 */
	private function saveChangesInSession() {
		$_SESSION['red'] = $this;
	}
}


/**
 * Clase User: simula la tabla User de la base de datos
 *
 * Ejemplo: <b>$miUser = new User(int $id, string $name, string $pass, string $mail);</b>
 *
 * @author Álex Torres
 */
class User
{
	/**
	 * @ignore
	 */
	private $id;
	/**
	 * @ignore
	 */
	private $name;
	/**
	 * @ignore
	 */
	private $pass;
	/**
	 * @ignore
	 */
	private $mail;
	
	/**
	 * @ignore
	 */
	function __construct($id, $name, $pass, $mail)
	{
		$this->id = $id;
		$this->name = $name;
		$this->pass = password_hash($pass, PASSWORD_DEFAULT);
		$this->mail = $mail;
	}
	
	/**
	 * @ignore
	 */
	public function __set($name, $value)
	{
		if(strcmp($name, 'pass')==0)
			$this->$name = password_hash($value, PASSWORD_DEFAULT);
		else
			$this->$name = $value;
	}
	
	/**
	 * @ignore
	 */
	public function __get($name)
	{
		return $this->$name;
	}
	
	/**
	 * @ignore
	 */
	public function toArray(){
		return get_object_vars($this);
	}
}

/**
 * Clase Revel: simula la tabla Revel de la base de datos
 *
 * Ejemplo: <b>$miRevel = new Revel(int $id, int $userID, string $text[, time $timestamp);</b>
 *
 * @author Álex Torres
 */
class Revel
{
	/**
	 * @ignore
	 */
	private $id;
	/**
	 * @ignore
	 */
	private $userId;
	/**
	 * @ignore
	 */
	private $text;
	/**
	 * @ignore
	 */
	private $timestamp;
	
	/**
	 * @ignore
	 */
	function __construct($id, $userId, $text, $timestamp = null)
	{		
		$this->id = $id;
		$this->userId = $userId;
		$this->text = $text;
		if(is_null($timestamp)) {
			$fecha = new DateTime();
			$this->timestamp = $fecha->getTimestamp();
		}
		else {
			$this->timestamp = $timestamp->getTimestamp();
		}
	}
	
	/**
	 * @ignore
	 */
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
	
	/**
	 * @ignore
	 */
	public function __get($name)
	{
		return $this->$name;
	}
	
	/**
	 * @ignore
	 */
	public function toArray(){
		return get_object_vars($this);
	}
}

/**
 * Clase Comment: simula la tabla Comment de la base de datos
 *
 * Ejemplo: <b>$miComment = new Comment(int $id, int $revelId, int $userID, string $text[, time $timestamp);</b>
 *
 * @author Álex Torres
 */
class Comment
{
	/**
	 * @ignore
	 */
	private $id;
	/**
	 * @ignore
	 */
	private $revelId;
	/**
	 * @ignore
	 */
	private $userId;
	/**
	 * @ignore
	 */
	private $text;
	/**
	 * @ignore
	 */
	private $timestamp;
	
	/**
	 * @ignore
	 */
	function __construct($id, $revelId, $userId, $text, $timestamp = null)
	{		
		$this->id = $id;
		$this->revelId = $revelId;
		$this->userId = $userId;
		$this->text = $text;
		if(is_null($timestamp)) {
			$fecha = new DateTime();
			$this->timestamp = $fecha->getTimestamp();
		}
		else {
			$this->timestamp = $timestamp->getTimestamp();
		}
	}
	
	/**
	 * @ignore
	 */
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
	
	/**
	 * @ignore
	 */
	public function __get($name)
	{
		return $this->$name;
	}
	
	/**
	 * @ignore
	 */
	public function toArray(){
		return get_object_vars($this);
	}
}


/**
 * Clase Follow: simula la tabla Follow de la base de datos
 *
 * Ejemplo: <b>$miFollow = new Follow(int $user, int $userFollowedId);</b>
 *
 * @author Álex Torres
 */
class Follow
{
	/**
	 * @ignore
	 */
	private $userId;
	/**
	 * @ignore
	 */
	private $followedId;
	
	/**
	 * @ignore
	 */
	function __construct($userId, $followedId)
	{		
		$this->userId = $userId;
		$this->followedId = $followedId;
	}
	
	/**
	 * @ignore
	 */
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
	
	/**
	 * @ignore
	 */
	public function __get($name)
	{
		return $this->$name;
	}
	
	/**
	 * @ignore
	 */
	public function toArray(){
		return get_object_vars($this);
	}
}
?>