<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => "Primature",
                'type' => "Primature",
                'address' => "Cité Ministérielle, Djibouti",
                'phone' => "+25321325214",
                'email' => "contact@primature.gouv.dj",
                'website' => "https://primature.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Administration du Premier Ministre et coordination du gouvernement."
            ],
            [
                'name' => "Ministère de la Justice et des Affaires Pénitentiaires",
                'type' => "Ministère",
                'address' => "Djibouti, District de Djibouti",
                'phone' => "+2532133333",
                'email' => "contact@justice.gouv.dj",
                'website' => "https://justice.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Supervise le système judiciaire, les prisons et la protection des droits de l'homme."
            ],
            [
                'name' => "Ministère de l'Économie et des Finances",
                'type' => "Ministère",
                'address' => "Cité ministérielle BP 13, Djibouti",
                'phone' => "+25321325105",
                'email' => "cabinet@economie.gouv.dj",
                'website' => "https://economie.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère la politique économique, financière, industrielle et budgétaire du pays."
            ],
            [
                'name' => "Ministère des Affaires Étrangères et de la Coopération Internationale",
                'type' => "Ministère",
                'address' => "P.B 1863, Rue Marchand, Djibouti",
                'phone' => "+25321352471",
                'email' => "contact@diplomatie.gouv.dj",
                'website' => "https://diplomatie.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Conduit la diplomatie et la coopération internationale de Djibouti."
            ],
            [
                'name' => "Ministère de la Défense",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321352034",
                'email' => "contact@defense.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Assure la défense nationale et les relations avec le Parlement."
            ],
            [
                'name' => "Ministère de l'Intérieur",
                'type' => "Ministère",
                'address' => "Cité Ministerielle, Djibouti-ville",
                'phone' => "+25321352542",
                'email' => "contact@interieur.gouv.dj",
                'website' => "https://interieur.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère la sécurité intérieure, la police, et la protection civile."
            ],
            [
                'name' => "Ministère du Budget",
                'type' => "Ministère",
                'address' => "Cité Ministérielle, BP 470, Djibouti-ville",
                'phone' => "+25321325301",
                'email' => null,
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Supervise l'élaboration et le suivi du budget de l'État."
            ],
            [
                'name' => "Ministère de la Santé",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321351931",
                'email' => "contact@sante.gouv.dj",
                'website' => "https://sante.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère la politique de santé publique et les services hospitaliers."
            ],
            [
                'name' => "Ministère de l'Éducation Nationale et de la Formation Professionnelle",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321350997",
                'email' => "contact@education.gouv.dj",
                'website' => "http://www.education.gov.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Dirige l'éducation nationale et les formations professionnelles."
            ],
            [
                'name' => "Ministère de l'Enseignement Supérieur et de la Recherche",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321351210",
                'email' => "contact@enseignementsuperieur.gouv.dj",
                'website' => "http://www.mensur.gov.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Encadre l'enseignement supérieur et la recherche nationale."
            ],
            [
                'name' => "Ministère de la Femme et de la Famille",
                'type' => "Ministère",
                'address' => "Boulevard Hassan Gouled, Djibouti",
                'phone' => "+25321353409",
                'email' => "contact@famille.gouv.dj",
                'website' => "https://famille.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Promeut les droits des femmes et le bien-être familial."          
            ],
            [
                'name' => "Ministère de l'Agriculture, de l'Eau, de la Pêche, de l'Élevage et des Ressources Halieutiques",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321351297",
                'email' => "contact@agriculture.gouv.dj",
                'website' => "http://www.maem.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Encadre la production agricole, l'eau, la pêche et l'élevage."
            ],
            [
                'name' => "Ministère des Infrastructures et de l'Équipement",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321357913",
                'email' => "contact@infras.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Supervise les infrastructures publiques et l'équipement."
            ],
            [
                'name' => "Ministère de l'Environnement et du Développement Durable",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321351097",
                'email' => "info@environnement.dj",
                'website' => "http://www.environnement.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère les questions environnementales et le développement durable."
            ],
            [
                'name' => "Ministère des Affaires Musulmanes et des Biens Wakfs",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321325462",
                'email' => "contact@affairesmusulmanes.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Administre les affaires religieuses musulmanes et les biens wakfs."
            ],
            [
                'name' => "Ministère de l'Énergie chargé des Ressources Naturelles",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321325431",
                'email' => "contact@energie.gouv.dj",
                'website' => "http://www.mern.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Supervise le secteur de l'énergie et l'exploitation des ressources naturelles."
            ],
            [
                'name' => "Ministère du Travail chargé de la Formalisation et de la Protection Sociale",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321350497",
                'email' => "contact@travail.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère le travail, la formalisation et la protection sociale."
            ],
            [
                'name' => "Ministère de la Ville, de l'Urbanisme et de l'Habitat",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321350006",
                'email' => "contact@habitat.gouv.dj",
                'website' => "https://logement.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Planifie l'urbanisme et la politique du logement."
            ],
            [
                'name' => "Ministère de la Communication, chargé des Postes et Télécommunications",
                'type' => "Ministère",
                'address' => "P.B 32 Boulevard Georges Pompidou",
                'phone' => "+25321353928",
                'email' => "contact@communication.gouv.dj",
                'website' => "https://communication.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Gère la communication médiatique, postes et télécommunications."
            ],
            [
                'name' => "Ministère du Commerce et du Tourisme",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321325441",
                'email' => "contact@commerce.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Encadre le commerce intérieur/extérieur et la promotion touristique."
            ],
            [
                'name' => "Ministère des Affaires Sociales et des Solidarités",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321325481",
                'email' => "contact@affairessociales.gouv.dj",
                'website' => "https://sociales.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Soutient les politiques sociales et la solidarité nationale."
            ],
            [
                'name' => "Ministère de la Jeunesse et de la Culture",
                'type' => "Ministère",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321355886",
                'email' => "contact@jeunesse.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Encourage la jeunesse, la culture, les arts et le sport."
            ],
            [
                'name' => "Ministère Délégué chargé de la Décentralisation",
                'type' => "Ministère délégué",
                'address' => "Djibouti, République de Djibouti",
                'phone' => "+25321325987",
                'email' => "contact@decentralisation.gouv.dj",
                'website' => "https://decentralisation.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Supervise les collectivités locales et le processus de décentralisation."
            ],
            [
                'name' => "Ministère Délégué chargé de l'Économie Numérique et de l'Innovation",
                'type' => "Ministère délégué",
                'address' => "Place la Garde, Djibouti",
                'phone' => "+25321339231",
                'email' => "contact@numerique.gouv.dj",
                'website' => "https://numerique.gouv.dj/",
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Encourage l’économie numérique, la TIC et l'innovation."
            ],
            [
                'name' => "Sécrétaire d'État chargé des Investissements et du Développement du secteur privé",
                'type' => "Secrétaire d'État",
                'address' => "Djibouti, République de Djibouti",
                'phone' => null,
                'email' => "contact@investissement.gouv.dj",
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Promeut les investissements et le développement du secteur privé."
            ],
            [
                'name' => "Sécrétaire d'État chargé des Sports",
                'type' => "Secrétaire d'État",
                'address' => "Djibouti, République de Djibouti",
                'phone' => null,
                'email' => null,
                'website' => null,
                'schedules' => "8h-13h et 13h-17h",
                'logo' => null,
                'description' => "Développe les politiques sportives nationales."
            ],
        ];

        foreach ($data as $institution) {
        $conditions = ['name' => $institution['name']];
        $values = collect($institution)->except('name')->toArray();

        Institution::updateOrCreate($conditions, $values);
    }

    }
}
