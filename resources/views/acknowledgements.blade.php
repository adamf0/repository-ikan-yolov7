@extends('template')
 
@section('css')
<style>
/*page 2*/
*{
    --primary: #136c72;
}
footer{
    bottom: 0;
}
.grid{
    display: grid;
    grid-template-columns: repeat(2, minmax(10vmax, 1fr));
    grid-gap: 50px;
    padding: 10px;
}
.box{
    background: var(--primary);
    padding: min(8vmax, 80px) 0;
    font-size: 22px;
    color: white;
    opacity: .8;
    border-radius: 10px;
}
.box--icon{
    font-size: 54px;
    margin-bottom: 20px;
}

.section2{
    /* padding: 50px 0; */
    text-align: left;
}

.content__section--grid{
    display: grid;
    grid-template-columns: 1fr;
    grid-row-gap: 10px;

    & .panel{
        height: 15vmax;
        background: var(--primary);
        opacity: .7;
        display: flex;
        justify-content: center;
        align-items: center;
        
        & h3{
            font-size: 1.7rem;
            color: white;
        }
    }
    & .panel__content{
        & p{
            font-size: .9rem;
            color: #3b3b3b;
        }
    }
}
/*end page 2*/
</style>
@stop

@section('content')
<section class="section2">
        <div class="content__section--grid">
            <div class="panel">
                <h3>Acknowledgements</h3>
            </div>
            <div class="container panel__content">
                <p>Kami berterima kasih kepada orang-orang berikut atas kontribusinya terhadap pengembangan <nama aplikasi>:</p>
                <ol>
                    <li>nama kontributor A</li>
                    <li>nama kontributor B</li>
                    <li>nama kontributor C</li>
                </ol>
            </div>
        </div>
    </section>
@stop

@section('script')
<script>
    $(document).ready(function () {

    });
</script>
@stop