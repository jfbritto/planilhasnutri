@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Planilhas</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="card-deck mb-2">
                <div class="card">
                    <a href="/planilha/troca-elemento-filtrante">
                        <img class="card-img-top" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBYVFRgVFRUYGBgZGRkZHBgYHBoZGBgZGBoZGhgYGBgcIS4lHB4rIRgYJjgmKy8xNTU1GiQ7QDszPy40NTEBDAwMEA8QHxISHjQrISQ1NDQxNDQ0NDQ0NDQ0MT80NDQ0PzQ0NDQ0MTQ2NDQ0NDQ0MTQxNDQ0NDQ0NDQ0NDE0NP/AABEIAKgBLAMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAAEAQIDBQYAB//EAEsQAAIBAQQECwUFBQYDCQAAAAECABEDBCExBRJBUQYiMmFxgZGhscHRE0JScpJiorLS4RQjM4LCFiRDU+LwBxWzNERjZHN0o/Hy/8QAGAEBAQEBAQAAAAAAAAAAAAAAAAIDAQT/xAAfEQEBAQACAgMBAQAAAAAAAAAAAQIREjFRAyFBMhP/2gAMAwEAAhEDEQA/ALs3la596+sb+0Df4HwlsUAJFWrRcdYk0qaUJ64w2f2m+6fEQK72g5+wx/tBz9hhZu6VWuOORVKVoc6CKbkv2etE9IFbasDtkLIN47RLS0uYoeSBQ4hKUFOYiK9yBy1ac+vXtDQKpBSSa8LOjRuX6rT80hOjcBq0OdcTvOWBgQM8aryR9GtuH1D8kaNHEDGta5BhgKDbQQGlxGEiK1z5n7VP9Uj/AGNsTV88BRSaUz5UBxEbSN/Z23v9A8iY02LgE1OYGKtXLcBAlUSRYLxx/wDi09I5NehNQMaYgjYDtgTPICYj2h3p9QHnIGds8MSfeGzOm+ARWcBBNZt3YayRGag4rdkCYpG6sjdyBkwkZtemBOFk62jjJ2HQxEAFtznsMf7Ub4Fgl9tRlav9besnTSdsP8Vus18ZUC1HxSRbQbx2wLxNMW/x16VX0ko05bDap6V9JUWRwjmEC5XT9ptVD1MPOSJwgbai9RIlDjEV9lYGkXT422f3v0ko02m1G7jM2oO4yb2bbj2QNANM2e5x1D1jxpay3kfynymaFmx2RRZNu7xtgaYaRsz7/c3pHC9offXtlAl1fm7YRY3RjtGcC39onxL2idxfs90BFwOHGEJTRuHL7v1gQuOMehfFo2ke7ZmhpxRka7dnXGe0G5vpb0gMYcZfm/paEUkIYFloDnuI91t4kptl39xgD3xwEavwnwMQ3hQM5WabvSarDWFdVsOoyp0tfFRCNcA4YVFYGmS9BsFx6MZCjsByGzOw7zAOBR17N3rWrKK55BvWaTUgVL27/A/UrHykd2V2LHUKjWrVwVrgBlnsl1qTtSBVtdn+z2n0kKXdwWJAxI28wHlLZlg7a+sctXDpyNe+nfAC1G3d4iJUM1csKdmMJtJA0BQ0YhqW5iPwiOCx62Y3ZwIXErrV88syMhLO8CmHR31lRatifmaA0gbQvYPSTWFkrqpZVJoNg7pBWT2FoFs1ZjQAZwOtbsgUnUGAJkFsVBJOGPxMPOQXjSusCtmlagjWbAdQGcG1WdtZzjuGAHQJF3J4XnFvkamoWUZkk+8TTA40J/3WSNdRvPbXxEjSxVhSOCOvJbqbGcnye1X4/TluoqRU1wNeLz4ZR4uH2j2D0iWd5oxLrSoAquIwr17Ydd7RXPFYHm29kqal8IubPKS7XAao5Jw95anrxky3QA5JWhpxKbsTj/usIu/JEe/KHQ39MpIYo+5O8REJGxTntIxqeaFEQanifxGA/WJoKDP4v0jyW+A9ojFGK9Ih1IAFSK8U4nIUwwHPEDE0GqwxGdNhHPCNXFunyERl8R4iBLZ2o3N9JhNg4GdcSdh9INZiH3TI9JgPDg0p4HcZMlqtMxOrl0+RkwMCvXlHoHnJKREHGbq84+kCF816fIx5ES0GK/N/S0eRAodN4KxGYUkdIBme0/8Aw+sTR6dHEb5W8DM5wi/h9YgXHAZf7sTvdu6aINjQIzGlaLTLfiRKLgQv91Hzv5TS3U8c/J/VABfSKKSGVgRmDq+sa+lbIZmnTq+sNvujktjrqwByqKMD0ypvPBpmztvuDDvgMtdNWAzfsBPhB307d/jP0Wn5ZDb8Ez/nL12Y9ZUXvgyy/wCIh/k/WBavpqw+P7r/AJZF/wA2sT/iDsb0mWvOhCDy0+g+sgXQjHIp9LesDaJpOx/zE7ZYWLqwBUgg5EGoPXM1oTRosRhix5TeQ3CXej+S3zv+IjygMv61JxIxGRps/WVhsg3vMKE41xJ7Ife34x6fJYBYnlfMYCLdftv930gt4TXCopJVM60xIru6ZcWVztHUlEJ58ABz1Mp7VXQlBq4ZmtcerMydX6afHmW8oLW9oimhx3DE16JVWem9Z1UoRUgYY4kU2c4EsLW4AiuuSa1woBG3e5ezqyU1j71AWGFDqtSorzTL6bXlJcb3LMW9ZX3exELVaSROmMV7qM8jvGfbEsrQbYUzrSOAJ+0Wi4K7ddD4x4v1vgdYGlc1G3o6IjOtc5xtFne19udc+jzf7f41+kSFtIWw2oeld5rsMUuImEdtezrn0VNMWgoSiGhrhrDzMJHCZhnYdj+qwTVEabITvep6ZFnhLn+4bE15Q3Dm5oxuE/8A4DZj3xsPywQ2QjDZCO+j/ODhwqI/7ufr/wBEksuGDjAXYZ7bQ/kld7AR6WAjvTpFt/aq2OVii9LM3pH/ANp7x8Fl2P8AmlWqSXVnO2vZ0jbLZnHjY4Y0E7Ub4u4SReU3V4R09DBAUNRVtuGG2h/WIVb4h9P6yS0zXp/pMUwM9ppHoauoFDXinKmPvTL8J3bU5S01stU17azW6f5DfK3gZj+FJ4g+aBrOBC/3RK7Sx8Jf3blvzKv9UpeBq0ullzgnvl1dzxnxpxVxOQwbEwIdH2ln7MaqMFJbBmFailcajm7JI9ovwtX5xvp8c64+0NmtbRXarVdWFCK4AHUNeyOtFff3j8kAK85HiP8AV/rlBpF6e6/1n80uL6bTeO0fkmc0i7V5Z7BAAc45P1mviYZdEy4rdkFu9mxPK7hL+53dqcofT+sB92sa7COkUnaOSuG93/6jyysLKgxx6qQLRWznLntdjAp9J2pDtQA8dszT4RuMGu+tsCmrGvGyy5sYt/NXPzP+Ijyk2jEwPzHyga+46i2ADHVB1vEzM2uhirlrO2Q1JPGBBFST0HOH2dWIqcBgBultd7AGcs5VnVz4Zqw4PO9aumNciTnzD1gmk9EPZMiK2vVakkUpQ0wxm4N32ym0qauOZQO8nznOkd76Zs3BsKaw6Sp8IwXa0HujtEtbf3fmHgYhMdYdqrRYv8IGW0Vi2txdwKMw34J3ceFPyuoeJkymOsc7UCuhuKOPa12n92R2V85BbaJtxyDrcxAQ9WJHfL+6niDpb8Rj68YdDf0xcwmqxVrbWiHVdSp5xSvRvjkvRm4ezVxqsoYHYwBHYZT2vBqzepRmQ1OXGXM+6cewybhU37UqXmTLbR944N26YoUccx1W7Gw74BbWdrZfxLN0G8qdX6su+Rc1c1B3tDFFpK9L0Dtkq2onOHeR6vJFaApac8lFrOcOjA0fWCJaR2vHDvLfpaLVjUUwxrhlHe2X4l7RA7S/hA7MrkLjRUZmOGxVFSZWW3CywQazpboKgVe72yLU5DWZAO+el5V29opK0YHHYeYzjbr8Q7RM8eG10w47jHHiNlQ82+kuNFaUsryheyYsoYqSVK4gA0oRuIgVen7wmqRrrUqRSo3GY/hVarqgawrrZVm306aKSMwCR1CZLhXyF6YGu4Ij+52HyV7zLZT/ABTTW4gwGZoGwHTK/g2tLtYj7A8TDgeLanW1MOUfdovK6s4HaPVPZpSyKjjUVuMV4xri2OOfXOtVSn8P7q+sW6P+7StsGNCdbCjcY41OOGXVI7e1Gxxu2QKm/hKH9390TLX7VJ5HcJotIW4/zB2CZq8WnG5fcIBVwOOCnsHrNLc2w5LdkzNwfHljsE1FxOR16joECxscdh6xKnRQ5B+yT219Zco438/ZKnQ68RD9gd4EDM3xwHx3scj8bwzRTCnSzUzxoI1xxu3vZj5wu5nlV2HyEA67CXd08pTXYS6uogTvlMxpS3UWjAnEU2HcDu55prTKZ69Yu3T4QKy0tVNACTxhsPPzRhvC7z2N6Qu2GXzCcVgA+0BJIrSg2HeeaPFqOf6W9ISi8bq85PSANdrcBRWuZ2HaSd0kW2BYHHAGuB5uaSWJw62/EZxPGHQfKA9byvP9LekfY2wAxriScmyqeaKsWyPi3iYEntQaAVzGw+knF4Xn+lvSQlsukQkGBTX/AEbYOSWshic1VlbIZlQD2yntuDKk/u3danJ0LDtoKd81mtienyEa7ZdI8ROXMrstjDW2hrymSa43pXwYA90Ee0dOWjp86lfET01TFQ1r0ybiKm68xW+DfH/tYnoN40bYORr2NmanMotcjtpWQHgtdDj7Dse1A7A1JPRXdrjnKvhAAyWSsKg3iwwOIwtAcuqV72t7IYC1QNsogIAptrmZS6S0dfrwoR70AoZX4iBDVa04ykHbvmrJs1udn/lp9C+kgayVGYKoUVBooAHJXYOiY1OC1t71/t8dzPu53l3oi4vYIUNs1qSxbWfWZhUAUFWyw74EfCDkt8reEyPCw8ROk+E0+nWbVILqBQ14hrTb70yPC3WovGFKmgpj21gegaDFLvY/+mvhDbugYWisKgtQjeCow74JooUsLL5E/CIQ1mpxIBMCYWCKoVVIAFABrigxPmYPeFXE0bseI1gnwjsg9pdk+BewQKnSCrjgfvTOWqAtke+ay3uqfAn0iBm6pXkJ9IgV+j7IKa07Kmai6PhkeyVlldU+BPpEOsbsnwJ9IgWL2nFJocAc8NnPK/RQoigg1CL3AVkrWKDEIo6AJHY8o54KdsCgYY9Q78YRdBg/zeSwf9mDUJLclcmYDkjYDCLBQoIFeVtJJOANanpgWN1Eu7tlKW5y6u4wgPtZQ2mJJ5z4y9tzM213RuMVBJgNvAy+YRSsY9gi0IRa1GzfB/ZL8C9ggFIvH/l85IYPd0WpGotKA5DfJTdk+BewQG2TgDMZttHxGcXXWHGGAbaPsx1ii05IzIyGwkRdQawFBiDsGykBVtk+Ne0TrO1UDFhiWpiMeMZMqDcItiKjrI7CYDRbKaAMDiMjCP2hPiEa2FOkSaAKbZcTXAnDPcJ3tQaAbxsO8SUHFunyES0OHWPEQJFvC8/0t6RUtQK54k+6fSCq0KupwPSYDvaAkUBwNcjuMnFsNzfSZG2a9PkZPARTxm6vCOJkStxm6vCcXG+AtqeT0n8LSPWkVvbCq4jM7fstA30ig99fqHrAG4QHiHoPhMrwtbBOuXmlr8jqQHUmhyIMzXCq8rrBdYVGyB6XdHC2SVNKIncokqWytkwPXPOjpd7VUbWKgLQAEgbq8+FI6y0haJyXYdBgehs8gtHG+YlNMWo989YU+Iky6ctdpU9KL5CBobe0G+Ce1G+Vn/OXOaWZ/lI8DGvpVv8AKQ9FR6wLuytRvh1laCZT/nqAY2ZB+EGpPQaUkX9qFGVietgPKBr73e1RdZjQQG56Vs3LapNdU4UNdmPfM9/a7/y69b/6IJacI3Zw4s1WilaBjtINa05u+Bo/aKqhmYKKDEkAZDfFsLQMWKkEa2YNRyV2zzvSGjv2m0LveQnwqyOwUfCpB8hWaHg41jdrL2ftlclixYIy5gDKm4CBuLnLmxyHTMUnCOwT3yehTHPw3sgOKrn+UAd5gbC+vRWO4HuEpEyHQJkr/wAM7Z6hQqKQRkSTXn2YSsGn7cZP3esDdXnIfMPGDLMknCO2qNYqwqMCN3RNRotltkDh35xxcD2QDLvyj8vnCDIUsACRVqkZ13HZHG7D4n+owHWAw/mb8RikcZehvKRWdipG3MjlNsJ54q2aggUzB380AoCJY5H5m8TILJbJuTqNTDChx3RSo+FcKgYDeYBLsMMRmPGSG1X4l7RBUwIoBmNghmoNwgDC1XE6wxO/PARr2qkUBBNRl0iSk4nmPkIjHLpHiIA62g5+xvSF3a0AXEHEn3W9JKsRNvSYHe0qRg2GOR3GS+2+y3ZIrTZ1+BiVgdqJxl1VoCMKZmmZkTWKfAvYIutxn6vCRu8BlqVUrRVFSRls1SfKROBuHZGXhuMnzH8LRzQBb2aIxFKhSR1CY3hG1bSbC/HiP8reExWnm/eGBNdsEX5R4R+tGJkOgRawHl52vIiYlYE3tJPd7TGBVkti2MA69XcMKiVVpYy6RsKQW2s4FSUnUhFslJAYCUiFY6R2r6orSsB1J2qN0jsbYNXYRG29uVNKd/dAe9nIismR6iuwwZbUk0IA2dcB80XBO+lX9meS1SOnAeQ7JQESa4W2paI1aAMKnmOB7oHpJPH/AJfMRxMFVmJxZdbVyocMca44yO8O4UkMtaYDV29sAiyOB+ZvxGVfCG+FE4poWBUdZUHurKe7adcsyO2o4JotAAcTWh31rI9Mln1CNZqEk41phu6T3SLueFTN8rfRbal3DDAjjd+t4S7RwwDDI1PaTKK7HVsihz1aU24r4c8lu+kU1AuqGYVGLUFMSNuO3smeNcW8r1OYvFzX5hDSw3zPXa1dnAVUFDidXLrl37NfhXsE1zqa8IueDC6gmrDPeNwjWtVNAGBxGR55IgGOAwO7mEc+AFN48ZSSi8Lv7iYqWg58Sdh9I9Y6yOfSYETPXJW27KbDvjeN8Dd3rJ3OK9PkZJAqmtG4zamZFBUbs8IO1q/wDrf/AEx9ieM/SvhFMAYlyy6wUUJODEknVIpkN8VjafYH1H0jrfNPmP4WkrQK29K+q2syAUNaK1aUx96YrTesbVsR2Tc3/kP8reBmG0uf3jQDFyiEzowwFJiViExKwHVk1icZBWS2GcC0s8o1jKjSmmTZHURNZtp2DmlBb6ft2+z0QNhaJWANZEmi48wxOEzCG82wqodlrTW92udNdsK81awyw4O3thrcjbx3Iy+Wu8QLk2R5vqWvZWsYUJ2E9VZHc9A2y2lijW9PasVqAWpRHetCwrglNmc9D0b/AMPktLKztGvD1dFcgKuBZQ1MSd8Dz1LtQ1CkfyufKSGwBzK/zBvSelL/AMNrDbb23V7P8kB07wRut1sXtHtXZlUlUdgC7ZKo1aHEkYgYQMItgoHLXq/WkYyKPePUFP8AVGPegRhYIOlrX84jHvaKK6qA9LEffYwHsU3ns9DBrW3RdpJ3DM90rb5fGbkEHOuqFoB0gf7pDLoAfZGlW1DrUzLFAeN0EnsgazRWm2CprocARUnGlag0lnbaYs9XW1q8w5XZMs4OodXdh2QZSMxkw76Z9nhML8ljXpKK0qPbMdRaMCSpJprAknzhFwdxTXzoceYbTK5HODZEUw3Z91cIbYXoO2ocGKsRuOriQOegMm6uvKusz4W6OhIDA11S3KoaZVpmSKiu4cwkSFa0OIrQbc8VINOiVV9syltauHo6WiutfeVzqinNsP2TLmxKOq2i4q1DqnMcY1U86nCd1PonlcXS/hQVIrSj1AAOBxFOaop09ZtrreltF1l2YGuYMo0uwVEc46xQU2arEVrvNPGXiXRBgEWnRNcS8fbPVn4cjjjVI5XkJz2qmgDCtRhUb41EXEaowOGA3CObClMMR4y0JVvC/EOrHwi2dqAMjiTsO/ojlkROPWfGBI1pUiithU5U2c8f7U/Afu+sGXlDr8ITWBUWPKfpXwkkYbBBrKNbYSdZq82Na7JCbqm0E9JJ8TAW3zT5j+Bor2qjNgOsSNrJEKkItSSK0y4pPlIDqjJFHVAjv15TUca61KtQAiuUxOlLQe1YV2zY3q2IViAMATlzTH6Q/iHpgGVjCY6NMBDEnGJAUSaxzkIk1hnAutF6NS0Qsy1Jd+5qDwi3jg1Yn3YVoE/uv53/ABmWpygeU3VD+0JZazant1XUDELQ2gU4VoKgntm9bQ9moooZeZXdR2BqTE3Yf3pP/cL/ANQT0xxAzVpoohldXcFKlTra2rUFTTWrsZh1yxstIXoKF/aLQKoCgKVUAAUAGqBsh1quECSwcWOuzAu1aLhxdwI7IEN4trZ+VeLx0C3tQOwPSUlx0HZm2LXn2roa8h6uTjSpbq2y9vN2K2agPrORVj8JJFR4xbezRaKja1FFScydsDJXLg7QsbYKQTxQrNguPKOFTlNNwb0bZr7QKiihUZV92uZ6YxzDeD7fxfnA/wDjQ+cAjTV1Au1rQf4b/hM83uI469f4TPUNKmthaDfZv+EzzPRNDbJXIk5/KYFpYvQ6p6j5GDMlCy9Y8R31h9vZqC2IIoOcZmV95fLM6u2hyOwzHef2Nca/KcLUmm7V1erGnl2TrtiynEFSGHSP9iMs3wNDgfWvjFU8au4eYmPLQVplNYI+ymofloKD+Wg6iOeLoO2OoynZaVHSQobxB6pYogazIPMeg7DKy5HVDr7wYMDsZaFSerymnPMTx9tXdL1rolmeUtoo6VW0PfQTRAzCWNsQ1QaEMWruy/MZprrbB1DY7iCzHHbtmmNc/VZ6z+rJDi3zeQjbe8KoqWGBG2DayBGdlBCazYCpooqaV24TKWNtaXxWtbJCU1tQLxUoaA6o1iK0BGI2kzRDVtptByQT0VJ7ADIf+eWQajsUJy1ktB/TMba8H72ST7Fjicdez6vejbvwfvxYMtjQqQQXezZaqagapbHHYRSBuTpi7BlAt0YkE8WtBgcCxAAOGRht3va2ihkoQdusJ5w/BK/O5Z1s01mrQOqrTEsAqVCjKgENseAt5A/jovMC35YGxblv0L5xpnToEN4zT5j+B4I06dADv3If5W8Jk77/ABD8w8Z06AZGmdOgNMSdOgKJPYZzp0DSaC/hn53/ABVloZ06B5hZGl5HNbD8c9KLTp0CK8vhBFVxY67Ea7AlVGBG4Edk6dAivNi62agPrOwBJFOLUio6hWJeUVSFVtaiirbztnToAztDuD44tod9pX7lmPKdOgWd7WqP8jfhM814N/8AabH5wO0ETp0DbaXsOMaZUB7zM9elwbmBnToFCrGmsMBUjooaVhlxxNDuPhOnTzXy9E8LfR1rVCCcQPD/AO4C6kWrKDgylwN5GJ7tadOnM+SjbsMCdtKHmp/sGXOh7Wjsu8V6x+nhOnSp/Tl/kZpm9Czuts20hkXeWcaooNudeqEaCuQu93srLAMKFsffarP2E06p06ehgtFvCfED0Y+EfZWtBk2JJyO8zp0BGckg6pwrnQV753tG+EfV+k6dA//Z" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Troca do Elemento Filtrante</h5>
                    {{-- <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/higienizacao-filtro-aparelho-climatizacao">
                        <img class="card-img-top" src="https://blog.adias.com.br/wp-content/uploads/2022/06/post_thumbnail-d7828643207ddbb6ff3c0cd43e615cbb-780x450.jpeg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Higienização dos Filtros e Aparelhos de Climatização</h5>
                    {{-- <p class="card-text">Este é um card com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/saturacao-oleo-gordura">
                        <img class="card-img-top" src="https://img.mfrural.com.br/api/image?url=https://s3.amazonaws.com/mfrural-produtos-us/300085-297674-2328503-oleos-vegetais-e-gorduras-compra.webp&width=266&height=174" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Saturação de Óleos e Gorduras</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/limpeza-caixa-gordura">
                        <img class="card-img-top" src="https://www.tgservices.com.br/wp-content/uploads/2022/02/24-02-22.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Limpeza de Caixa de Gordura</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/registro-congelamento">
                        <img class="card-img-top" src="https://portaleducacao.vteximg.com.br/arquivos/ids/158215/curso-online-congelamento-de-alimentos.jpg?v=636573274855400000" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Congelamento</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/verificacao-procedimento-higienizacao-hortifruti">
                        <img class="card-img-top" src="https://i0.wp.com/www.totalissaude.com.br/wp-content/uploads/2020/07/como-limpar-alimentos-totalis.jpg?fit=650%2C430&ssl=1" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Verificação do Procedimento de Higienização de Hortifrutis</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>
            <div class="card-deck mb-2">
                <div class="card">
                    <a href="/planilha/manutencao-calibracao-equipamento">
                        <img class="card-img-top" src="https://www.startlabsp.com.br/imagens/informacoes/manutencao-calibracao-equipamentos-medicao-01.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Relatório de Manutenção e calibrações dos equipamentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/registro-limpeza">
                        <img class="card-img-top" src="https://centrallimp.com.br/wp-content/uploads/2019/11/post-05-11-1024x697.png" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Limpeza</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/recebimento-materia-prima">
                        <img class="card-img-top" src="data:image/jpeg;base64,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" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Recebimento de Matéria Prima</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/resfriamento-rapido-alimento">
                        <img class="card-img-top" src="https://www.nutrimixassessoria.com.br/wp-content/uploads/2018/11/nutrimix-veja-a-importancia-do-controle-de-temperatura-dos-alimentos.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Resfriamento Rápido de Alimentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/reaquecimento-alimento">
                        <img class="card-img-top" src="https://consultoradealimentos.com.br/wp-content/uploads/2017/09/t_106_steak_small.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Reaquecimento dos Alimentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/registro-nao-conformidade-detectada-auto-avaliacao">
                        <img class="card-img-top" src="https://www.8quali.com.br/wp-content/uploads/2016/07/road-sign-663368_1920-820x400-1-770x400.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Não Conformidades Detectadas na Auto Avaliação</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>
            <div class="card-deck mb-2">
                <div class="card">
                    <a href="/planilha/temperatura-alimento-banho-maria">
                        <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Bain-marie.JPG/1200px-Bain-marie.JPG" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Temperatura dos Alimentos no Banho-Maria</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/temperatura-alimento-distribuicao">
                        <img class="card-img-top" src="https://blog.praticabr.com/wp-content/uploads/2022/12/temperatura-dos-alimentos.jpeg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Temperatura dos Alimentos na Distribuição</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/grupo-amostra-prato">
                        <img class="card-img-top" src="https://blog.castellmaq.com.br/wp-content/uploads/2022/01/204482-armazenamento-de-alimentos-como-fazer-de-forma-correta.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Grupo de Amostras de Pratos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/avaliacao-manejo-residuo">
                        <img class="card-img-top" src="https://www.vertown.com/uploads/2017/10/checklist-para-res%C3%ADduos-perigosos.-5.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Check-list de Avaliação do Manejo dos Resíduos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/ocorrencia-praga">
                        <img class="card-img-top" src="https://fenixempresas.com.br/wp-content/uploads/2022/01/Design-sem-nome-37.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Ocorrência de Pragas</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/temperatura-equipamento-area-climatizada">
                        <img class="card-img-top" src="https://www.pahcautomacao.com.br/wp-content/uploads/2022/05/Blog_como_funcionam_os_controladores_de_temperatura.jpg" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Temperatura de Equipamentos e Áreas Climatizadas</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
