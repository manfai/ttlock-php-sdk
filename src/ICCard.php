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
class ICCard extends TTLockAbstract
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
	 * @param int $lockId
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author manfai
	 */
	public function list( int $lockId, int $pageNo = 1, int $pageSize = 20) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/list', [
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

		/**
	 * @param int $lockId
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author manfai
	 */
	public function delete( int $lockId, int $pageNo = 1, int $pageSize = 20) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/delete', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'cardId'      => $cardId,
				'deleteType'  => 2,
				'date'        => number_format(round(microtime(true) * 1000),0,'.','')
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && isset( $body['errcode'] )&& $body['errcode']==0){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}


	/**
	 * @param int $lockId
	 * @param int $cardId
	 * @param int $startDate
	 * @param int $endDate
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author manfai
	 */
	public function changePeriod( int $lockId, int $cardId, int $startDate, int $endDate) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/changePeriod', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'cardId'	  => $cardId,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'changeType'  => 2,
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
	 * @param int    $cardId
	 * @param string $cardName
	 * @param int    $startDate
	 * @param int    $endDate
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 * @author manfai
	 */
	public function add( int $lockId, int $cardId, string $cardName, int $startDate, int $endDate) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/addForReversedCardNumber', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'cardNumber'  => $cardId,
				'cardName'	  => $cardName,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'addType' 	  => 2,
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

}