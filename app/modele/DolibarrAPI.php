<?php

class DolibarrAPI
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = "http://172.27.0.56/dolibarr/htdocs/api/index.php";
        $this->apiKey = "b6226dbb4c47d3d911e87fececb0683585eb8bd4"; // À mettre dans un fichier .env idéalement
    }

    private function request(string $endpoint, string $method = "GET", array $data = null)
    {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $this->baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "DOLAPIKEY: " . $this->apiKey,
                "Content-Type: application/json"
            ],
            CURLOPT_CUSTOMREQUEST => $method
        ];

        if ($data !== null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    public function getInvoices()
    {
        return $this->request("/invoices");
    }

    public function getExpenseReports()
    {
        return $this->request("/expensereports");
    }

    public function getBankAccounts()
    {
        return $this->request("/accounts");
    }
}
