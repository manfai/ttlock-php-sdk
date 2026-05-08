<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: mannfai
 * Date: 2018/9/13
 * Time: 下午8:59
 *
 */

namespace ttlock;
class Lock extends TTLockAbstract
{

	/**
	 * @var string
	 */
	private $accessToken = '';

	public function setAccessToken( string $accessToken  ) : void
	{
		$this->accessToken = $accessToken;
	}

	/**
	 * @param string $lockData
	 * @param string $lockAlias
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function initialize( string $lockData, string $lockAlias ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/initialize', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockData'    => $lockData,
				'lockAlias'   => $lockAlias,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}

	}

	/**
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function list( int $pageNo, int $pageSize ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/list', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'pageNo'      => $pageNo,
				'pageSize'    => $pageSize,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	public function gateways( int $pageNo, int $pageSize ) : array
	{
		$response = $this->client->request( 'POST', '/v3/gateway/list', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'pageNo'      => $pageNo,
				'pageSize'    => $pageSize,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	public function setGroup( int $lockId, int $groupId ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/setGroup', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'groupId'     => $groupId,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			 return (array)$body;
		//	throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
	 public function addGroup( string $groupName ) : array
        {
                $data = [
                        'form_params' => [
                                'clientId'    => $this->clientId,
                                'accessToken' => $this->accessToken,
                                'name'            => $groupName,
                                'date'        => number_format(round(microtime(true) * 1000),0,'.','')
                        ],
                ];
                $response = $this->client->request( 'POST', '/v3/group/add', $data);
                $body     = json_decode( $response->getBody()->getContents(), true );
                if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
                        return (array)$body;
                } else{
                        $response = $this->client->request('POST', '/v3/group/list', $data);
                        $body  = json_decode( $response->getBody()->getContents(), true );
                        if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
                                $index = array_search($groupName, array_column($body['list'], 'groupName'));
                                return $body['list'][$index];
                        } else{
                                return (array)$body;
                        }
                        // throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
                }
        }
	
	/**
	 * @param int $lockId
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function listKey( int $lockId, int $pageNo, int $pageSize ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/listKey', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'pageNo'      => $pageNo,
				'pageSize'    => $pageSize,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}


	/**
	 * @param string $lockId
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function deleteAllKey( string $lockId ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/deleteAllKey', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $lockId
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function listKeyboardPwd( int $lockId, int $pageNo, int $pageSize ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/listKeyboardPwd', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'pageNo'      => $pageNo,
				'pageSize'    => $pageSize,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @param string $password
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function changeAdminKeyboardPwd( int $lockId, string $password ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/changeAdminKeyboardPwd', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'password'    => $password,
				'changeType'  => 2,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function detail( int $lockId ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/detail', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		// dd($lockId);
		$body = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200){
			return $body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
	
	/**
	 * @param int    $lockId
	 * @param string $password
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function changeDeletePwd( int $lockId, string $password ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/changeDeletePwd', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'password'    => md5( $password ),
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @param string $password
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function deleteKeyboardPwd( int $lockId, int $keyboardPwdId ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/keyboardPwd/delete', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'keyboardPwdId'   => $keyboardPwdId,
				'deleteType'    => '2',
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @param string $lockAlias
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function rename( int $lockId, string $lockAlias ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/rename', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'lockAlias'   => $lockAlias,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $lockId
	 * @param     $date
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function resetKey( int $lockId, $date  ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/resetKey', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int    $lockId
	 * @param string $pwdInfo
	 * @param int    $timestamp
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function resetKeyboardPwd( int $lockId, string $pwdInfo, int $timestamp ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/resetKeyboardPwd', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'pwdInfo'     => $pwdInfo,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $lockId
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function getKeyboardPwdVersion( int $lockId ) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/getKeyboardPwdVersion', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param int $lockId
	 * @param int $electricQuantity
	 * @param int $date
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function updateElectricQuantity( int $lockId, int $electricQuantity ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/updateElectricQuantity', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'electricQuantity' => $electricQuantity,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @param string $receiverUsername
	 * @param string $lockIdList
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function transfer( string $receiverUsername, string $lockIdList ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/transfer', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'receiverUsername' => $receiverUsername,
				'lockIdList'       => $lockIdList,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
	
	/**
	 * @param int $lockId
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function unlock( int $lockId ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/unlock', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
	 /**
         * @param int $lockId
         * @return bool
         * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
         * @author mannfai
         */
        public function unfreeze( int $lockId ) : bool
        {
                $response = $this->client->request( 'POST', '/v3/lock/unfreeze', [
                        'form_params' => [
                                'clientId'         => $this->clientId,
                                'accessToken'      => $this->accessToken,
                                'lockId'           => $lockId,
                                'date'             => number_format(round(microtime(true) * 1000),0,'.','')
                        ],
                ] );
                $body     = json_decode( $response->getBody()->getContents(), true );
                if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
                        return true;
                } else{
                        throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
                }
        }
		
	/**
	 * @param int $lockId
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function lock( int $lockId ) : bool
	{
		$response = $this->client->request( 'POST', '/v3/lock/lock', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] ) && $body['errcode'] === 0 ){
			return true;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
	/**
	 * @param int $lockId
	 * @param int $startDate
	 * @param int $endDate
	 * @param int $pageNo
	 * @param int $pageSize
	 * @return bool
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author 韩文博
	 */
	public function lockRecord( int $lockId, int $startDate = 0, int $endDate = 0, int $pageNo = 1, int $pageSize = 20) : array
	{
		$response = $this->client->request( 'POST', '/v3/lockRecord/list', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'startDate'        => $startDate,
				'endDate'          => $endDate,
				'pageNo'           => $pageNo,
				'pageSize'         => $pageSize,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	public function updateSetting( int $lockId, int $type = 7, int $value) : array
	{
		$response = $this->client->request( 'POST', '/v3/lock/updateSetting', [
			'form_params' => [
				'clientId'         => $this->clientId,
				'accessToken'      => $this->accessToken,
				'lockId'           => $lockId,
				'type'             => $type,
				'value'            => $value,
				'changeType'       => 2,
				'date'             => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] )&& $body['errcode']==0){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}
