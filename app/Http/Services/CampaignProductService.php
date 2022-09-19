<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\CampaignProductInterface;
use Exception;

class CampaignProductService {

    protected CampaignProductInterface $campaignProduct;

    public function __construct(CampaignProductInterface $campaignProduct) {
        $this->campaignProduct = $campaignProduct;
    }

    /**
     * @throws Exception
     */
    public function create(array $data) {
        return $this->campaignProduct->create($data);
    }

//    public function getAll() {
//        return $this->campaign->getAll();
//    }
//
//    /**
//     * @throws Exception
//     */
//    public function getOne($id) {
//        $campaign = $this->campaign->getOne($id);
//
//        if (is_null($campaign)){
//            throw new Exception("Campaign not found!", 404);
//        }
//
//        return $campaign;
//    }
//
//    /**
//     * @throws Exception
//     */
//    public function update(array $data, $id) {
//        $campaign = $this->campaign->getOne($id);
//
//        if (is_null($campaign)){
//            throw new Exception("Campaign not found!", 404);
//        }
//
//        if ($data['active']){
//            //ESTOU TENTANDO ADICIONAR UMA CAMPANHA ATIVA.
//            //VERIFICAR SE JÁ POSSUI ALGUMA PARA ESSE GRUPO DE CIDADES
//
//            $activeCampaigns = $this->campaign->getActivesByGroupCities($data['group_cities_id']);
//
//            if (sizeof($activeCampaigns)){
//                //POSSUO CAMPANHAS ATIVAS
//                throw new Exception('There is already an active campaign for this group of cities!', 400);
//            }
//        }
//
//        $updated = $this->campaign->update($campaign, $data);
//
//        if (!$updated) {
//            throw new Exception("Error when updating!", 400);
//        }
//
//        return $this->campaign->getOne($id);
//    }
//
//    /**
//     * @throws Exception
//     */
//    public function delete($id): array
//    {
//        $campaign = $this->campaign->getOne($id);
//
//        if (is_null($campaign)){
//            throw new Exception("Campaign not found!", 404);
//        }
//
//        $updated = $this->campaign->delete($campaign);
//
//        if (!$updated) {
//            throw new Exception("Error removing!", 400);
//        }
//
//        return [];
//    }

}
