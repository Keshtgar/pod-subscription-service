<?php
/**
 * Created by PhpStorm.
 * User :  keshtgar
 * Date :  6/28/19
 * Time : 10:29 AM
 *
 * $baseInfo BaseInfo
 */
namespace Pod\Subscription\Service;
require __DIR__ . '/../vendor/autoload.php';

use Pod\Base\Service\BaseService;
use Pod\Base\Service\ApiRequestHandler;
use Exception;


class SubscriptionService extends BaseService
{
    private $header;
    private $serverType;
    private static $subscriptionApi;

    public function __construct($baseInfo)
    {
        parent::__construct();
        self::$jsonSchema = json_decode(file_get_contents ('jsonSchema.json'), true);
        $this->serverType = $baseInfo->getServerType();
        $this->header = [
            "_token_issuer_"    => $baseInfo->getTokenIssuer(),
            "_token_"           => $baseInfo->getToken(),
        ];
        self::$subscriptionApi = require __DIR__ . '/../config/apiConfig.php';
    }

    public function addSubscriptionPlan($params) {
        $apiName = 'addSubscriptionPlan';
        array_walk_recursive($params, 'self::prepareData');

        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        $option = [
            'headers' => $this->header,
            $paramKey => $params, // set query param for validation
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // prepare params to send
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function subscriptionPlanList($params) {
        $apiName = 'subscriptionPlanList';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // prepare params to send
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function updateSubscriptionPlan($params) {
        $apiName = 'updateSubscriptionPlan';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function requestSubscription($params) {
        $apiName = 'requestSubscription';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            //TODO: array control
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
//            if ($paramKey == 'query') {
//                $httpQuery = self::buildHttpQuery($params);
//                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
//                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
//            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function confirmSubscription($params) {
        $apiName = 'confirmSubscription';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            //TODO: array control
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
//            if ($paramKey == 'query') {
//                $httpQuery = self::buildHttpQuery($params);
//                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
//                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
//            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function subscriptionList($params) {
        $apiName = 'subscriptionList';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            //TODO: array control
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
//            if ($paramKey == 'query') {
//                $httpQuery = self::buildHttpQuery($params);
//                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
//                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
//            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }

    public function consumeSubscription($params) {
        $apiName = 'consumeSubscription';
        $paramKey = self::$subscriptionApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$subscriptionApi[$apiName]['subUri'];

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            //TODO: array control
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
//            if ($paramKey == 'query') {
//                $httpQuery = self::buildHttpQuery($params);
//                $relativeUri = self::$subscriptionApi[$apiName]['subUri'] . "?" . $httpQuery;
//                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
//            }
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$subscriptionApi[$apiName]['baseUri']],
                self::$subscriptionApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }
    }
}