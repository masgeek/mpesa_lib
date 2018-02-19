<?php

define ('HMAC_SHA256', 'sha256');
define ('SECRET_KEY', '6bdfc11529bb456f839760579c56c115e5160d5b5b94429e98212cb3b78a210bb998d868ea304896aa6039ad62a0df08818d20a351554f67b5ada57cdeb306c1d9b0e09278644f2cb701a11846653622a1d7772700454ea8b0b605ce7ee15c8e07cb718b55d5480fb1b5a5f8f114662f7d7f845343fd4e8fb36a94e4b1c024f2');

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
