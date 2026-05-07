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

    // ------------------------
    // ------------ Tiers (Thirdparties) ------------
    // ------------------------

    // NOUVEAU : Récupérer la liste des Tiers
    public function getTiers()
    {
        return $this->request("/thirdparties");
    }

    // ------------------------
    // ------------ Factures ------------
    // ------------------------

    public function getInvoicesAll()
    {
        return $this->request("/invoices");
    }

    public function getInvoicesById($id)
    {
        return $this->request("/invoices/" . $id);
    }

    public function getInvoicesByRef($ref)
    {
        // $urlRef = urlencode($ref);
        return $this->request("/invoices/ref/" . $ref);
    }

    public function createInvoice(array $data)
    {
        return $this->request("/invoices", "POST", $data);
    }

    public function deleteInvoice(int $id)
    {
        return $this->request("/invoices/" . $id, "DELETE");
    }

    // ------------------------
    // ------------ Dépense ------------
    // ------------------------

    public function getExpenseReports()
    {
        return $this->request("/expensereports");
    }

    // ------------------------
    // ------------ Banque ------------
    // ------------------------

    public function getBankAccounts()
    {
        return $this->request("/bankaccounts", "GET");
    }

    public function getBankAccountsById($id)
    {
        return $this->request("/bankaccounts/" . $id, "GET");
    }

    public function createBankAccount(array $data)
    {
        return $this->request("/bankaccounts", "POST", $data);
    }

    public function updateBankAccount(int $id, array $data)
    {
        return $this->request("/bankaccounts/" . $id, "PUT", $data);
    }

    public function deleteBankAccount(int $id)
    {
        return $this->request("/bankaccounts/" . $id, "DELETE");
    }
}
